/* eslint-disable react/prop-types */
/* eslint-disable no-unused-vars */
import { Button, Input, ModalBody, ModalFooter, ModalHeader, Select, SelectItem, Spinner, Textarea } from "@nextui-org/react"
import { getArrayById } from "../../../utils/utils";
import useForm from "../../../hooks/useForm";
import { STORE_TASK_API, UPDATE_TASK_API } from "../../../api/apis";
import Alert from "../../../components/Alert";
import { useSelector } from "react-redux";

const TaskForm = ({ id }) => {

    const user = JSON.parse(localStorage.getItem('user'));
    const tasks = useSelector((state)=> state.professor.tasks)

    // -------------------API------------------------
    let apiKey = id ? `${UPDATE_TASK_API}/${user.id}/${id}` : `${STORE_TASK_API}/${user.id}`
    const method = id ? "put" : "post";
    const task = getArrayById(tasks, 'id', id);

    const initialState = {
        'taskName': id ? task[0]['taskName'] : '',
        'description': id ? task[0]['description'] : '',
        'sector': id ? task[0]['sector'] : '',
        'deadline': id ? task[0]['deadline'] : ''
    }

    const { inputs, errors, message, isLoading, handleChange, handleSubmit } = useForm(initialState, apiKey, method, false, true)

    return (
        <div>
            <form onSubmit={handleSubmit} className="space-y-2">

                    {message && <Alert color='success' message={message} />}
                    <Input
                        variant="bordered"
                        label="Task Name"
                        value={inputs['taskName']}
                        errorMessage={errors['taskName']}
                        onChange={(e) => handleChange('taskName', e.target.value)}
                    />
                    <Textarea
                        variant='bordered'
                        label="Your description goes here"
                        value={inputs['description']}
                        errorMessage={errors['description']}
                        onChange={(e) => handleChange('description', e.target.value)}
                    ></Textarea>
                    <Select
                        items={user.sectors}
                        label="Sector"
                        variant='bordered'
                        defaultSelectedKeys={inputs['sector'] !== "" ? [inputs['sector']] : undefined}
                        errorMessage={errors['sector']}
                        onChange={(e) => handleChange('sector', e.target.value)}
                    >
                        {(user.sectors).map((sector) => (
                            <SelectItem key={sector} >{sector}</SelectItem>
                        ))}
                    </Select>
                    <Input
                        label={
                            <span className="bottom-1.5 text-xs relative">Deadline</span>
                        }
                        type='datetime-local'
                        variant='bordered'
                        value={inputs['deadline']}
                        errorMessage={errors['deadline']}
                        onChange={(e) => handleChange('deadline', e.target.value)}
                    />

                <ModalFooter>
                    <Button
                        type='submit'
                        className='bg-foreground text-background'
                        onClick={handleSubmit} disabled={isLoading}>
                        {isLoading ? (<div className='flex items-center gap-1'><Spinner size='sm' color="default" /> {id ? 'updating ...' : 'creating ...'} </div>) : id ? 'Update' : 'Create'}
                    </Button>
                </ModalFooter>
            </form>
        </div>
    )
}
export default TaskForm