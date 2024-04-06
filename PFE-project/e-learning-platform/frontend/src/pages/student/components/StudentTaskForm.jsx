/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable react-hooks/rules-of-hooks */
/* eslint-disable no-unused-vars */
/* eslint-disable react/prop-types */
import { Button, ModalBody, ModalFooter, ModalHeader, Spinner } from '@nextui-org/react';
import { getArrayById } from './../../../utils/utils';
import { useSelector } from 'react-redux';
import { DELETE_SUBMISSION_API, GET_SUBMISSION_API, STORE_SUBMISSION_API } from '../../../api/apis';
import useForm from '../../../hooks/useForm';
import Alert from '../../../components/Alert';

import remove from '../../../assets/icons/delete.svg'
import view from '../../../assets/icons/eye.svg'
import { useEffect, useState } from 'react';
import useFetch from './../../../hooks/useFetch';

const StudentTaskForm = ({ id }) => {


    const tasks = useSelector((state) => state.student.tasks)
    const task = getArrayById(tasks, "id", id)[0]
    const user = JSON.parse(localStorage.getItem('user'));

    const { data, isLoading: getSubmissionLoading } = useFetch(`${GET_SUBMISSION_API}/${user.id}/${task.id}`)
    let apiKey = `${STORE_SUBMISSION_API}/${user.id}/${id}`
    let method = 'post'
    let hasFileCheck = true

    const formattedDeadline = new Date(task.deadline).toLocaleString('en-US', {
        month: '2-digit',
        day: '2-digit',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        hour12: true
    });

    if (task.submitted) {
        apiKey = `${DELETE_SUBMISSION_API}/${user.id}/${task.id}/${data?.data.id}`
        method = 'delete'
        hasFileCheck = false
    }

    const initialState = {
        'file': null,
    }

    const handleView = () => {
        const downloadUrl = `http://localhost:8000${data?.data.file}`;
        const anchor = document.createElement('a');
        anchor.href = downloadUrl;
        anchor.setAttribute('download', '');
        anchor.setAttribute('target', '_blank');
        anchor.click();
    }


    const { inputs, errors, isLoading, message, handleChange, handleSubmit } = useForm(initialState, apiKey, method, hasFileCheck, true)

    return (
        <div className='h-full flex flex-col'>
            {message && <Alert color='success' message={message} />}
            <ModalHeader className='gap-3 flex items-center justify-between -mb-4'>
                <div className='space-x-2'>
                    <span className='text-gray-600'>{task && task.taskName}</span>
                    {task.submitted ? (<span className='text-green-500 text-medium border border-green-600 px-2 rounded-md font-normal'>submitted</span>) : (<span className='text-red-500 text-medium border border-red-600 px-2 rounded-md font-normal'>Unsubmitted</span>)}
                </div>
                <div>
                    <span className='text-red-500 text-sm'>{formattedDeadline}</span>
                </div>
            </ModalHeader>
            <form onSubmit={handleSubmit}>
                <ModalBody className='flex-1'>
                    <span className='font-semibold text-black'>Description: <p className='text-xs font-normal text-gray-700'>{task.description}</p> </span>

                    <div className='flex items-center gap-1'>

                        {!task.submitted && <div className='flex-1'>
                            <label className="sr-only">Choose file</label>
                            <input
                                type="file"
                                onChange={(e) => handleChange('file', e.target.files[0])}
                                className="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-2 file:px-4 hover:border-gray-500"
                            />
                            {errors['file'] && <p className='text-xs text-pink-500'>{errors['file']}</p>}
                        </div>}


                        {/* action buttons */}

                        {task.submitted &&
                            <div className='flex items-center'>
                                <div className='space-x-1 flex items-center'>
                                    {/* <a
                                        target='_blank' rel="noreferrer"
                                        href={`http://localhost:8000${data?.data.file}`}
                                        className='bg-blue-500 inline-flex px-2 py-1 text-white rounded-md items-center justify-center'
                                    >
                                        view submission
                                        {
                                            getSubmissionLoading ? (<Spinner size='sm' color='current' />) :
                                                (<img
                                                    src={view}
                                                    className="size-4 invert mx-2"
                                                />)
                                        }
                                    </a> */}
                                    <Button
                                        onClick={handleView}
                                        size='sm'
                                        color='primary'
                                    >
                                        view submission
                                        {
                                            getSubmissionLoading ? (<Spinner size='sm' color='current' />) :
                                                (<img
                                                    src={view}
                                                    className="size-4 invert"
                                                />)
                                        }
                                    </Button>
                                    <Button
                                        type='submit'

                                        size='sm'
                                        color='danger'
                                    >
                                        delete submission
                                        {
                                            getSubmissionLoading ? (<Spinner size='sm' color='current' />) :
                                                (<img
                                                    src={remove}
                                                    className="size-4 invert"
                                                />)
                                        }
                                    </Button>
                                </div>
                            </div>
                        }
                    </div>

                </ModalBody>

                {
                    !task.submitted &&
                    <ModalFooter>
                        <Button
                            type='submit'
                            className="bg-foreground text-background mt-1"
                        >
                            {(isLoading) ? (<div className='flex items-center gap-1'><Spinner color="default" /> Submiting...</div>) : 'Submit'}
                        </Button>
                    </ModalFooter>}
            </form>
        </div>
    )
}
export default StudentTaskForm