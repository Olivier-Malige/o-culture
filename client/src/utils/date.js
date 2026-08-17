const monthList = [
  'jan',
  'fev',
  'mar',
  'avr',
  'mai',
  'jun',
  'jul',
  'aou',
  'sep',
  'oct',
  'nov',
  'déc',
];

const asDateString = (date) => {
  if (typeof date === 'string') {
    return date;
  }
  if (date && typeof date === 'object' && typeof date.date === 'string') {
    return date.date;
  }
  return '';
};

export const formatDate = (date) => {
  const value = asDateString(date);
  if (value.length < 10) {
    return '';
  }
  const year = value.slice(0, 4);
  const month = value.slice(5, 7);
  const day = value.slice(8, 10);
  return `${day} ${monthList[month - 1]} ${year}`;
};

export const getHour = (date) => {
  const value = asDateString(date);
  if (value.length < 16) {
    return '';
  }
  return value.slice(11, 16);
};
