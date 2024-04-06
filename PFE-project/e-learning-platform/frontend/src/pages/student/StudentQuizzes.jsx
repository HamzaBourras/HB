import StudentLayoutForm from "./components/StudentLayoutForm"
import quizLogo from '../../assets/images/quizLogo.png'
import quizImage from '../../assets/images/quiz.png'
import StudentQuizForm from "./components/StudentQuizForm"
import { useSelector } from "react-redux"
import { getArrayById } from "../../utils/utils"

const StudentQuizzes = () => {

    // fetch data from redux store
    const quizzes = useSelector((state)=>state.student.quizzes)
    const UndoneQuizzs = getArrayById(quizzes, 'isDone', 'false')

    return (
        <div>
            <StudentLayoutForm
                title="Quizzes"
                imageLogo={quizLogo}
                data={UndoneQuizzs}
                image={quizImage}
                name="quiz"
                Component={StudentQuizForm}
            />
        </div>
    )
}
export default StudentQuizzes