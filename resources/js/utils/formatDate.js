import dayjs from 'dayjs';
export default function formatDate(date, format = 'DD.MM.YYYY - H:mm') {
    return dayjs(date).format(format);
}
