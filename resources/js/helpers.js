export default function moneyFormat(price) {
    return (price).toLocaleString('ru-RU', {
        style: 'currency',
        currency: 'RUB',
        // minimumFractionDigits: 0,
        // maximumFractionDigits: 0,
    });
}
