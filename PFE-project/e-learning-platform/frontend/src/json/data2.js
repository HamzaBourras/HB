import useFetch from '../hooks/useFetch';

let professorsData = null;

export const fetchProfessorsData = async (apiKey) => {
    const { data } = await useFetch(apiKey);
    professorsData = data;
};

export const getProfessorsData = () => {
    return professorsData;
};
