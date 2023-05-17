export async function getResponceJson(url) {
    const response = await fetch(url);
    
    if (response.ok) {
        let json = await response.json();
        return json;
    } else {
        console.log("Ошибка HTTP: " + response.status);
    }
};

export const getLocale = async () => {
    return await getResponceJson('/home/get-locale');
}