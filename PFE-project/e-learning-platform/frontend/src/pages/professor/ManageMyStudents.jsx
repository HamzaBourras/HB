import { useSelector } from "react-redux"
import TableComponentWithFilter from "../../components/Table/TableComponentWithFilter"
import { professorStudents } from "../../json/data"
import StduentImage from '../../assets/images/student-logo.png'

const ManageMyStudents = () => {
    const students = useSelector((state) => state.professor.myStudents)
    return (
        <div>
            <TableComponentWithFilter 

                Component="" 
                data={students} 
                columns={professorStudents}
                title="My Students"
                user="my-students" 
                imageLogo={StduentImage}
            />
        </div>
    )
}

export default ManageMyStudents