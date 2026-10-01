<?php

namespace App\Command;

use App\Entity\AppUser;
use App\Entity\Event;
use App\Entity\EventType;
use App\Entity\Place;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'app:demo:refresh-events',
    description: 'Supprime les événements passés et complète le calendrier à venir.'
)]
class RefreshDemoEventsCommand extends Command
{
    private const DEFAULT_TARGET = 30;

    private const EVENT_NAMES = [
        'Concert de jazz',
        'Concert de rock',
        'Exposition de photographie',
        'Soirée scène ouverte',
        'Spectacle de danse contemporaine',
        'Atelier de dessin',
        'Nuits théâtrales',
        'Rencontre avec un auteur',
        'Festival des musiques locales',
        'Projection et débat',
        'Exposition de sculpture',
        'Scènes musicales',
        'Humour : soirée d’impro',
        'Découverte des artistes de la région',
        'Théâtre : mise en scène',
        'Concert acoustique',
        'Atelier de photographie',
        'Danse et percussions',
        'Peinture en direct',
        'Lecture musicale',
    ];

    private const DESCRIPTIONS = [
        'Une soirée conviviale autour de la culture locale. Tout public.',
        'Découvrez des artistes de la région dans une ambiance chaleureuse.',
        'Une proposition accessible à toutes et tous. Réservation conseillée.',
        'Un rendez-vous culturel à partager entre amis ou en famille.',
        'Rencontre, découverte et échanges avec les artistes après l’événement.',
    ];

    public function __construct(private EntityManagerInterface $entityManager)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this->addOption(
            'target',
            null,
            InputOption::VALUE_REQUIRED,
            'Nombre minimal d’événements actifs à venir à maintenir.',
            self::DEFAULT_TARGET
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $target = filter_var($input->getOption('target'), FILTER_VALIDATE_INT);

        if ($target === false || $target < 0) {
            $io->error('L’option --target doit être un entier positif ou nul.');

            return Command::INVALID;
        }

        $now = new DateTimeImmutable();
        $upcomingCount = (int) $this->entityManager->getRepository(Event::class)
            ->createQueryBuilder('event')
            ->select('COUNT(event.id)')
            ->where('event.plannedDate >= :now')
            ->andWhere('event.isActive = :active')
            ->setParameter('now', $now)
            ->setParameter('active', true)
            ->getQuery()
            ->getSingleScalarResult();

        $missing = max(0, $target - $upcomingCount);

        if ($missing > 0) {
            $creator = $this->entityManager->getRepository(AppUser::class)
                ->createQueryBuilder('user')
                ->join('user.role', 'userRole')
                ->where('userRole.code = :role')
                ->setParameter('role', 'ROLE_ORGANIZER')
                ->setMaxResults(1)
                ->getQuery()
                ->getOneOrNullResult();
            $places = $this->entityManager->getRepository(Place::class)->findBy(['isActive' => true]);
            $eventTypes = $this->entityManager->getRepository(EventType::class)->findBy(['isActive' => true]);

            if (!$creator || !$places || !$eventTypes) {
                $io->error('Impossible de créer les événements : il faut au moins un compte organisateur, un lieu actif et un type actif.');

                return Command::FAILURE;
            }
        }

        $expiredCount = $this->removeExpiredEvents($now);

        if ($missing === 0) {
            $io->success(sprintf('%d événements expirés supprimés. Les %d événements à venir sont conservés.', $expiredCount, $upcomingCount));

            return Command::SUCCESS;
        }

        for ($index = 0; $index < $missing; ++$index) {
            $place = $places[array_rand($places)];
            $event = new Event();
            $event->setName(sprintf('%s — %s', self::EVENT_NAMES[array_rand(self::EVENT_NAMES)], $place->getCity()));
            $event->setPlannedDate($this->randomFutureDate($now));
            $event->setNbSpectator(random_int(30, 350));
            $event->setPrice(random_int(0, 35));
            $event->setDescription(self::DESCRIPTIONS[array_rand(self::DESCRIPTIONS)]);
            $event->setAppUserCreator($creator);
            $event->setEventPlace($place);
            $event->setEventType($eventTypes[array_rand($eventTypes)]);

            $this->entityManager->persist($event);
        }

        $this->entityManager->flush();

        $io->success(sprintf('%d événements expirés supprimés, %d événements ajoutés. Il y en a maintenant au moins %d à venir.', $expiredCount, $missing, $target));

        return Command::SUCCESS;
    }

    private function randomFutureDate(DateTimeImmutable $now): DateTimeImmutable
    {
        $daysAhead = random_int(2, 60);
        $hour = random_int(10, 21);

        return $now->modify(sprintf('+%d days', $daysAhead))->setTime($hour, random_int(0, 1) * 30);
    }

    private function removeExpiredEvents(DateTimeImmutable $now): int
    {
        $expiredEvents = $this->entityManager->getRepository(Event::class)
            ->createQueryBuilder('event')
            ->where('event.plannedDate < :now')
            ->setParameter('now', $now)
            ->getQuery()
            ->getResult();

        foreach ($expiredEvents as $event) {
            $this->entityManager->remove($event);
        }

        if ($expiredEvents) {
            $this->entityManager->flush();
        }

        return count($expiredEvents);
    }
}
