/* eslint-disable react/prop-types */
import { Input, Textarea, Button, Spinner, Select, SelectItem, ModalBody } from '@nextui-org/react'
import useForm from '../../../hooks/useForm';
import Alert from '../../../components/Alert';
import { getArrayById } from '../../../utils/utils';
import { STORE_COURSE_API, UPDATE_COURSE_API } from '../../../api/apis';
import { useSelector } from 'react-redux';
import { useState } from 'react';

const CourseForm = ({ id }) => {

    const courses = useSelector((state) => state.professor.courses)
    const user = JSON.parse(localStorage.getItem('user'));

    const [fileCheck, setFileCheck] = useState(false)

    const method = id ? "put" : "post";


    let apiKey = id ? `${UPDATE_COURSE_API}/${user.id}/${id}` : `${STORE_COURSE_API}/${user.id}`

    const course = getArrayById(courses, 'id', id)[0]

    const initialState = {
        'courseName': id ? course['courseName'] : '',
        'sector': id ? course['sector'] : '',
        'description': id ? course['description'] : '',
        'file': null,
    }


    const { inputs, errors, isLoading, message, handleChange, handleSubmit } = useForm(initialState, apiKey, method, fileCheck, true)

    console.log(inputs);

    return (
        <div>
            <ModalBody className='flex-1'>
                {message && <Alert color='success' message={message} />}
                <form onSubmit={handleSubmit} className='space-y-1.5'>
                    <Input
                        type='text'
                        variant='bordered'
                        label="Course Name"
                        value={inputs['courseName']}
                        errorMessage={errors['courseName']}
                        onChange={(e) => handleChange('courseName', e.target.value)}
                    />

                    <Select
                        items={user.sectors}
                        label="Sector"
                        variant='bordered'
                        defaultSelectedKeys={inputs['sector'] !== "" ? [inputs['sector']] : undefined}
                        errorMessage={errors['sector']}
                        onChange={(e) => handleChange('sector', e.target.value)}
                    >
                        {(user.sectors).map((sector) => (
                            <SelectItem key={sector} >{sector}</SelectItem>
                        ))}
                    </Select>


                    <Textarea
                        variant='bordered'
                        label="Your description goes here"
                        value={inputs['description']}
                        errorMessage={errors['description']}
                        onChange={(e) => handleChange('description', e.target.value)}
                    ></Textarea>
                    <div>
                        <label className="sr-only">Choose file</label>
                        <input
                            type="file"
                            onChange={
                                (e) => {
                                    handleChange('file', e.target.files[0])
                                    setFileCheck(true)
                                }
                            }
                            className="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-2 file:px-4 hover:border-gray-500"
                        />
                        {errors['file'] && <p className='text-xs text-pink-500'>{errors['file']}</p>}
                    </div>
                    <div className='space-x-3'>
                        <Button type='submit' variant='shadow' className='bg-foreground text-background'>
                            {id ? 'Update' : 'Upload'} {isLoading && <Spinner color='default' />}
                        </Button>
                    </div>
                </form>
            </ModalBody>



        </div>
    )
}

export default CourseForm