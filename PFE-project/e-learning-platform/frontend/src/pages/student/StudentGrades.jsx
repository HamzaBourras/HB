import { categories } from "../../json/data"
import gradeImage from '../../assets/images/grades.png'
import result from '../../assets/images/result.png'
import StudentLayoutForm from './components/StudentLayoutForm';
import { useSelector } from "react-redux";
const StudentGrades = () => {

    const grades = useSelector((state)=>state.student.grades)
    
    return (
        <div>
            <StudentLayoutForm 
                title="grades" 
                imageLogo={gradeImage} 
                tabs={categories}
                data={grades}
                image={result}
                name="grade"
            />
        </div>
    )
}
export default StudentGrades