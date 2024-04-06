/* eslint-disable no-unsafe-optional-chaining */
import { Navigate, useParams } from 'react-router-dom';
import { VIEW_SUBMITTED_STUDENT_QUIZ, VIEW_SUBMITTED_STUDENT_TASKS } from './../../../api/apis';
import useFetch from './../../../hooks/useFetch';
import LoadingPage from './../../../components/LoadingPage';
import { Avatar } from '@nextui-org/react';

import downloadIcon from '../../../assets/icons/download.svg'

const ResultComponent = () => {

    const userRole = JSON.parse(localStorage.getItem('user')).role
    const { name, id } = useParams();
    let apiKey = ""
    switch (name) {
        case 'task':
            apiKey = `${VIEW_SUBMITTED_STUDENT_TASKS}/${id}`
            break;

        case 'quiz':
            apiKey = `${VIEW_SUBMITTED_STUDENT_QUIZ}/${id}`
            break;

        default:
            break;
    }

    const { data, isLoading } = useFetch(apiKey)

    if (userRole != "professor") {
        return <Navigate to={`/auth/${userRole}`} replace />;
    }

    return (
        <>
            <h1 className='text-lg font-semibold mb-3'>All students who submitted this {name}</h1>
            <div className='w-full flex'>
                {isLoading && <LoadingPage />}
                {
                    data ? (data?.data).map((student, index) => (
                        <div
                            key={index}
                            className=''
                        >
                            <div className={`flex flex-col justify-center items-center border size-32 mx-1 px-2 py-2 rounded hover:bg-gray-50 hover:cursor-pointer`}>
                                <Avatar />
                                <div className='text-center'>
                                    <h1 className='text-sm font-medium text-balance text-gray-600'>{student.firstName}</h1>
                                    <h1 className='text-sm font-medium text-balance text-gray-600'>{student.lastName}</h1>
                                </div>
                                {name == 'quiz' && <h1 className='text-sm font-medium text-balance text-gray-100 bg-blue-500 px-5 rounded'>{student.studentNote}</h1>}
                                {name == 'task' &&
                                    <div className="space-x-1 flex justify-center">
                                        <a
                                            href={`http://localhost:8000${student.file}`}
                                            download
                                            className="bg-blue-600 px-4 hover:bg-blue-800 p-2 rounded flex items-center space-x-1">
                                            <img
                                                src={downloadIcon}
                                                alt=""
                                                className="size-3 invert"
                                            />
                                        </a>
                                    </div>
                                }
                            </div>
                        </div>
                    )) : (
                        <div>
                            No one has submitted this {name} yet !
                        </div>
                    )
                }
            </div>
        </>
    );
};

export default ResultComponent;
