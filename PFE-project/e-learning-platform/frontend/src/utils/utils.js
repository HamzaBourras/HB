/* eslint-disable no-unused-vars */
export function capitalize(str) {
    return str ? str.charAt(0).toUpperCase() + str.slice(1) : null
}

export const uncapitalize = (str) => {
    return str ? str.toLowerCase() : null
}

export const getArrayById = (array, colName, id) => {
    return array? id ? array.filter((item) => item[colName] == id) : array : []
};

export const generateUsername = (firstname, lastname) => {
    return firstname && lastname ? `${firstname.toLowerCase().charAt(0)}.${lastname.toLowerCase()}` : ''
}

export const countData = (array) => {
    let counter = 0;
    if (array) {
        array.forEach(i => {
            counter++
        });
        return counter
    }
    return 0
}

export const getRecentlyAddedData = (array, comparison, number) => {
    const sortedArray = array.sort((a, b) => b[comparison] - a[comparison]);
    const recentData = sortedArray.slice(0, number);

    return recentData;
}

export const sortArray = (array, method = "asc") => {
    const sortedArray = array.slice()
    switch (method) {
        case 'asc':
            return sortedArray.sort((a, b) => a.downloads - b.downloads);
        case 'desc':
            return sortedArray.sort((a, b) => b.downloads - a.downloads);
        default:
            return sortedArray
    }
}

export const shuffleArray = (array) => {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
};