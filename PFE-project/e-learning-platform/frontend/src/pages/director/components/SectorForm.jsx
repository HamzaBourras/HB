/* eslint-disable react-hooks/rules-of-hooks */
/* eslint-disable react/prop-types */

import { Input, Button, Spinner, Select, SelectItem } from '@nextui-org/react'
import useForm from '../../../hooks/useForm'
import Alert from '../../../components/Alert'
import { getArrayById } from '../../../utils/utils'
import { useSelector } from 'react-redux'
import { STORE_SECTOR_API, UPDATE_SECTOR_API } from '../../../api/apis'


const SectorForm = ({ id }) => {

    //  -----------------------DATA------------------------------------------
    const departments = useSelector((state) => state.director.departments)
    const sectors = useSelector((state) => state.director.sectors)

    // ------------------------API-----------------------------------------
    const apiKey = id ? `${UPDATE_SECTOR_API}/${id}` : `${STORE_SECTOR_API}`
    const method = id ? "put" : "post";
    const sector = getArrayById(sectors, 'id', id);

    const initialState = {
        'sector': id ? sector[0]['sector'] : '',
        'department': id ? sector[0]['department'] : '',
    }

    const { inputs, errors, message, isLoading, handleChange, handleSubmit } = useForm(initialState, apiKey, method,false, true);


    return (
        <div className='px-1 space-y-2'>

            {message && <Alert color="success" message={message} />}
            <form onSubmit={handleSubmit}>
                <div className="grid grid-cols-2 gap-1">

                    <Input variant="bordered"
                        label="Sector name"
                        value={inputs['sector']}
                        errorMessage={errors['sector']}
                        onChange={(e) => handleChange('sector', e.target.value)}
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


export default SectorForm