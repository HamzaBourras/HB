import { useState, useEffect } from "react";
import axios from "axios";

const useFetch = (url, reRender = null, isPDF = false) => {
    const [data, setData] = useState(null);
    const [error, setError] = useState(null);
    const [isLoading, setIsLoading] = useState(false);

    useEffect(() => {
        const getData = async () => {
            setIsLoading(true);
            let headers = {
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            };
            // Conditionally set Content-Type header if isPDF is true
            if (isPDF) {
                headers['Content-Type'] = 'application/pdf';
            }

            await axios.get(url, {headers})
                .then((res) => {
                    setData(res.data);
                    setIsLoading(false);
                })

                .catch(error => {
                    setError(error.response?.data?.message)
                    console.error(error)
                })

                .finally(() => {
                    setIsLoading(false)
                })
        };

        getData();

        return setData(null)

    }, [url, reRender, isPDF]);

    return { isLoading, data, error }
};

export default useFetch;


