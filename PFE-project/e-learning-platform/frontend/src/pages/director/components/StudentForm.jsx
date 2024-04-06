/* eslint-disable react-hooks/rules-of-hooks */
/* eslint-disable react/prop-types */

import { Input, Button, Spinner, Select, SelectItem } from '@nextui-org/react'
import useForm from '../../../hooks/useForm'
import Alert from '../../../components/Alert'
import { useSelector } from 'react-redux'
import { STORE_STUDENT_API, UPDATE_STUDENT_API } from '../../../api/apis'
import { generateUsername, getArrayById } from '../../../utils/utils'


const StudentForm = ({ id }) => {

    //  -----------------------DATA------------------------------------------
    const students = useSelector((state) => state.director.students)
    const departments = useSelector((state) => state.director.departments)
    const sectors = useSelector((state) => state.director.sectors)

    // ------------------------API-----------------------------------------
    const apiKey = id ? `${UPDATE_STUDENT_API}/${id}` : `${STORE_STUDENT_API}`
    const method = id ? "put" : "post";
    const student = getArrayById(students, 'id', id);
    // --------------------------------------------------------------------
    const initialState = {
        'firstName': id ? student[0]['firstName'] : '',
        'lastName': id ? student[0]['lastName'] : '',
        'username': id ? student[0]['username'] : '',
        'email': id ? student[0]['email'] : '',
        'department': id ? student[0]['department'] : '',
        'sector': id ? student[0]['sector'] : '',
    }

    const { inputs, errors, message, isLoading, handleChange, handleSubmit } = useForm(initialState, apiKey, method,false, true)

    const sectorsBelongToDepartment = getArrayById(sectors, 'department', inputs['department']);

    return (
        <div className='px-1 space-y-2'>

            {message && <Alert color="success" message={message} />}

            <form onSubmit={handleSubmit}>
                <div className="grid grid-cols-2 gap-1">

                    <Input variant="bordered"
                        // className='col-span-2'
                        label="FirstName"
                        value={inputs['firstName']}
                        errorMessage={errors['firstName']}
                        onChange={(e) => {
                            handleChange('firstName', e.target.value)
                            handleChange('username', generateUsername(e.target.value, inputs['lastName']))
                        }
                        }
                    />

                    <Input variant="bordered"
                        label="LastName"
                        value={inputs['lastName']}
                        errorMessage={errors['lastName']}
                        onChange={(e) => {
                            handleChange('lastName', e.target.value)
                            handleChange('username', generateUsername(inputs['firstName'], e.target.value))
                        }}
                    />

                    <Input variant="bordered"
                        // className='col-span-2'
                        label="Email"
                        value={inputs['email']}
                        errorMessage={errors['email']}
                        onChange={(e) => handleChange('email', e.target.value)}
                    />

                    <Input variant="bordered"
                        // className='col-span-2'
                        readOnly
                        label="Username"
                        value={inputs['username']}
                        errorMessage={errors['username']}
                        onChange={() => { console.log("i am changing") }}
                    />

                    <Select
                        items={departments}
                        label="Departments"
                        variant='bordered'
                        defaultSelectedKeys={inputs['department'] !== "" ? [inputs['department']] : undefined}
                        errorMessage={errors['department']}
                        onChange={(e) => handleChange('department', e.target.value)}
                    >
                        {(department) => <SelectItem key={department.department} >{department.department}</SelectItem>}
                    </Select>

                    <Select
                        items={sectorsBelongToDepartment}
                        label="Sector"
                        variant='bordered'
                        defaultSelectedKeys={inputs['sector'] !== "" ? [inputs['sector']] : undefined}
                        errorMessage={errors['sector']}
                        onChange={(e) => handleChange('sector', e.target.value)}
                    >
                        {(sector) => <SelectItem key={sector.sector}>{sector.sector}</SelectItem>}
                    </Select>
                </div>
                <Button
                    type='submit'
                    className="bg-foreground text-background mt-1"
                >
                    {isLoading ? (<div className='flex items-center gap-1'><Spinner color="default" /> Loading...</div>) : id ? 'Update' : 'Create'}
                </Button>

            </form>
            {/* <Divider />
            {
                !id &&
                <>
                    <p className="text-small text-default-400">Upload Professors using CSV file instead</p>
                    <div>
                        <div className='flex items-center'>
                            <form className='flex gap-2'>
                                <label className="sr-only">Choose file</label>
                                <input type="file" accept='.csv' className="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none file:bg-gray-50 file:border-0 file:me-4 file:py-2 file:px-4" />
                                <Button
                                    className="bg-foreground text-background"
                                >Upload</Button>
                            </form>
                        </div>
                    </div>
                </>
            } */}

        </div>
    )
}


export default StudentForm