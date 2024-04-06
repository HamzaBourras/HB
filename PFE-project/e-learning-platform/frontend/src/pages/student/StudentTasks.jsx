import StudentLayoutForm from "./components/StudentLayoutForm"
import taskImage from '../../assets/images/to-do.png'
import StudentTaskForm from "./components/StudentTaskForm"
import { useSelector } from "react-redux"

const Tasks = () => {

    const tasks = useSelector((state)=> state.student.tasks)
    return (
        <div>
            <StudentLayoutForm 
                title="Tasks" 
                imageLogo={taskImage}
                data={tasks}
                image={taskImage}
                name="task"
                Component={StudentTaskForm}
            />
        </div>
    )
}
export default Tasks