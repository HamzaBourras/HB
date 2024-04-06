/* eslint-disable no-unused-vars */
import { Divider } from '@nextui-org/react'
import AnnounceImage from '../../assets/images/announcement.png'
import Ad from '../../assets/images/ad.png'
import AnnouncementForm from './components/AnnouncementForm';

import FormLayoutWithGrid from './components/FormLayoutWithGrid';
import { useSelector } from 'react-redux';

const ManageAnnouncements = () => {

    const announcements = useSelector((state) => state.professor.announcements);

    return (
        <div>
            <FormLayoutWithGrid 
                data={announcements} 
                imageLogo={AnnounceImage} 
                image={Ad} 
                Component={AnnouncementForm} 
                name="Announcement"     
            />
        </div>
    )
}

export default ManageAnnouncements
