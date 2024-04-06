import { createContext } from 'react';
import useFetch from '../../../hooks/useFetch';
import { ALL_PROFESSORS_API } from '../../../api/apis';
import LoadingPage from '../../../components/LoadingPage';
import Alert from '../../../components/Alert';

// Step 1: Create a context

// Step 2: Create a provider
const ProfessorsProvider = ({ children }) => {
    const ProfessorsContext = createContext();
    const apiKey = ALL_PROFESSORS_API;
    const { data, isLoading, error } = useFetch(apiKey);

    if (isLoading) {
        return <LoadingPage />;
    }

    if (error) {
        return <Alert color="danger" message={error.message} />;
    }

    return (
        <ProfessorsContext.Provider value={data.data}>
            {children}
        </ProfessorsContext.Provider>
    );
};

export default ProfessorsProvider