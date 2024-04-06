import StudentLayoutForm from "./components/StudentLayoutForm"
import courseImage from '../../assets/images/file.png'
import { useSelector } from 'react-redux';

const StudentCourses = () => {
    const courses = useSelector((state)=>state.student.courses)
    return (
        <div>
            <StudentLayoutForm
                title="Courses"
                imageLogo={courseImage}
                data={courses}
                image={courseImage}
                name="course"
            />
        </div>
    )
}
export default StudentCourses