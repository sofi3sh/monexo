export const sendData = async (url, data) => {
    const response = await fetch(url, {
        method: 'POST',
        body: data,
    });
    if (!response.ok) {
     throw new Error(`Ошибка по адресу url, статус ошибки ${response.status}`);
    }
    return await response.json();
}