/* eslint-disable react/prop-types */
import { Input, Button, Spinner, Select, SelectItem, ModalFooter } from '@nextui-org/react'

import useForm from '../../../hooks/useForm';
import Alert from '../../../components/Alert';
import { getArrayById } from '../../../utils/utils';
import { STORE_ANNOUNCEMENTS_API, UPDATE_ANNOUNCEMENT_API } from '../../../api/apis';
import { useSelector } from 'react-redux';

const AnnouncementForm = ({ id }) => {
    //  -----------------------DATA------------------------------------------
    const announcements = useSelector((state) => state.professor.announcements);
    const sectors = JSON.parse(localStorage.getItem('user')).sectors
    const user = JSON.parse(localStorage.getItem('user'));
    // ------------------------API-----------------------------------------

    const method = id ? "put" : "post";
    let apiKey = id ? `${UPDATE_ANNOUNCEMENT_API}/${user.id}/${id}` : `${STORE_ANNOUNCEMENTS_API}/${user.id}`

    const announcement = getArrayById(announcements, 'id', id)[0]

    const initialState = {
        'announcementName': id ? announcement['announcementName'] : '',
        'sector': id ? announcement['sector'] : '',
        'startDate': id ? announcement['startDate'] : '',
        'endDate': id ? announcement['endDate'] : '',
    }


    const { inputs, errors, isLoading, message, handleChange, handleSubmit } = useForm(initialState, apiKey, method, false, true)

    return (
        <div className="border border-dashed grid grid-cols-1 p-2 rounded space-y-2">
            {message && <Alert color='success' message={message} />}
            <form onSubmit={handleSubmit} className='space-y-1.5'>
                <Input
                    type='text'
                    variant='bordered'
                    label="Announcement"
                    value={inputs['announcementName']}
                    errorMessage={errors['announcementName']}
                    onChange={(e) => handleChange('announcementName', e.target.value)}
                />

                <Select
                    items={sectors}
                    label="Sector"
                    variant='bordered'
                    defaultSelectedKeys={inputs['sector'] !== "" ? [inputs['sector']] : undefined}
                    errorMessage={errors['sector']}
                    onChange={(e) => handleChange('sector', e.target.value)}
                >
                    {sectors.map((sector) => (
                        <SelectItem key={sector} >{sector}</SelectItem>
                    ))}
                </Select>

                {/* <div className='grid grid-cols-2 gap-1'>
                    <Input
                        type='datetime-local'
                        variant='bordered'
                        value={inputs['announcementName']}
                        errorMessage={errors['announcementName']}
                        onChange={(e) => handleChange('announcementName', e.target.value)}
                    />
                    <Input
                        type='datetime-local'
                        variant='bordered'
                        value={inputs['announcementName']}
                        errorMessage={errors['announcementName']}
                        onChange={(e) => handleChange('announcementName', e.target.value)}
                    />
                </div> */}

                <ModalFooter>
                    <Button
                        type='submit'
                        className='bg-foreground text-background'
                        onClick={handleSubmit} disabled={isLoading}>
                        {isLoading ? (<div className='flex items-center'><Spinner size='sm' color="default" /> {id ? 'updating ...' : 'creating ...'} </div>) : id ? 'Update' : 'Create'}
                    </Button>
                </ModalFooter>
            </form>



        </div>
    )
}

export default AnnouncementForm