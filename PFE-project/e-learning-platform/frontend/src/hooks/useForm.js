import { useState } from "react"
import axios from 'axios'

const useForm = (initialState = {}, api, method, hasFile = false, isAuth = false, logout = false) => {

    const [inputs, setInputs] = useState(initialState)
    const [errors, setErrors] = useState({})
    const [isLoading, setIsLoading] = useState(false)
    const [message, setMessage] = useState('');
    const [data, setData] = useState(null);

    const handleChange = (name, value) => {
        setInputs((prevInputs) => ({
            ...prevInputs,
            [name]: value,
        }));

        setErrors((prevErrors) => ({
            ...prevErrors,
            [name]: '',
        }));
    };



    const handleSubmit = async (e) => {
        e && e.preventDefault();
        setIsLoading(true);

        try {
            let config = {
                method: method,
                url: api,
                data: inputs,
                headers: { 'Content-Type': 'application/json' }
            }

            if (hasFile) {
                config.headers = { 'Content-Type': 'multipart/form-data' };
                // Create a FormData object and append inputs to it
                let formData = new FormData();
                for (let key in inputs) {
                    formData.append(key, inputs[key]);
                }
                config.data = formData;
            }

            if(isAuth){
                config.headers = { 'Authorization': `Bearer ${localStorage.getItem('token')}` }
            }
            // ---------------send data ----------------------
            const response = await axios(config);

            // ------------------------------------------------
            if (response.status === 200) {
                setMessage(response.data.message);
                setData(response);

                if (logout && response) {
                    localStorage.clear()
                    window.location.reload()
                }
            }

        } catch (error) {
            const err = error?.response?.data?.errors;
            let errorMessage = ''; // Define a variable to store the error message
            setErrors(err)

            if (error.response) {
                // The request was made and the server responded with a status code
                const status = error.response.status;

                switch (status) {
                    case 400:
                        errorMessage = "Bad request: The server cannot process the request due to a client error.";
                        break;
                    case 401:
                        errorMessage = "Unauthorized: The user is not authenticated to perform the request.";
                        break;
                    case 402:
                        errorMessage = "Payment Required: This status code is reserved for future use.";
                        break;
                    case 405:
                        errorMessage = "Method not allowed";
                        break;
                    // Add more cases for other status codes as needed
                    default:
                    // errorMessage = error.response.data?.message || "An error occurred while processing your request.";
                }
            } else if (error.request) {
                // The request was made but no response was received
                errorMessage = "No response received from the server.";
            } else {
                // Something else happened while setting up the request
                errorMessage = "An error occurred while making the request.";
            }

            // Set the error message in the message state variable
            setMessage(errorMessage);
        } finally {
            setIsLoading(false);
        }

    }

    return { inputs, errors, data, message, isLoading, handleChange, handleSubmit, setMessage }
}

export default useForm;