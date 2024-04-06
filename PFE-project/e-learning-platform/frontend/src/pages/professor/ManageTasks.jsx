import taskImage from '../../assets/images/to-do.png'
import FormLayoutWithGrid from "./components/FormLayoutWithGrid"
import TaskForm from "./components/TaskForm"
import { useSelector } from "react-redux"

const ManageTasks = () => {
    const tasks = useSelector((state)=> state.professor.tasks)

    return (
        <div>
            <FormLayoutWithGrid 
                data={tasks} 
                imageLogo={taskImage} 
                image={taskImage} 
                Component={TaskForm}
                name="Task" />
        </div>
    )
}

export default ManageTasks