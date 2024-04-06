/* eslint-disable no-unused-vars */
import file from '../../assets/images/file.png'
import CourseLogo from '../../assets/images/folder-Logo.png'
import CourseForm from './components/CourseForm';
import FormLayoutWithGrid from './components/FormLayoutWithGrid';
import { useSelector } from 'react-redux';

const ManageCourses = () => {
    const courses = useSelector((state)=>state.professor.courses);
    return (
        <>
            <FormLayoutWithGrid data={courses} imageLogo={CourseLogo} image={file} Component={CourseForm} name="Course" />
        </>
    )
}

export default ManageCourses