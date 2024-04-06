/* eslint-disable no-unused-vars */
import { useState } from "react";
import Papa from 'papaparse'

const useCSV = () => {
    
    const [data, setData] = useState(null);
    const [error, setError] = useState(null);
    const [isLoading, setIsLoading] = useState(false);

    const handleFileUpload = async (file) => {
        setIsLoading(true);
        setError(null);
        try {
            const parsedData = await csvToJson(file);
            setData(parsedData);

        } catch (error) {
            setError(error)
        } finally {
            setIsLoading(false);
        }
    }

    const csvToJson = (file) => {
        return new Promise((resolve, reject) => {
            if (file) {
                Papa.parse(file, {
                    complete: (result) => resolve(result.data),
                    header: true,
                    error: (error) => reject(error)
                })
            }
            else {
                reject(new Error("No file provided !"))
            }
        });
    }
    return { data, error, isLoading, handleFileUpload }

}

export default useCSV;