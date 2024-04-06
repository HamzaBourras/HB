import FormLayoutWithGrid from './components/FormLayoutWithGrid'
import quizImage from '../../assets/images/quiz.png'
import quizLogo from '../../assets/images/quizLogo.png'
import QuizForm from './components/QuizForm';
import { useSelector } from 'react-redux';

const ManageQuizzes = () => {
    const quizzes = useSelector((state) => state.professor.quizzes);
    return (
        <>
            <FormLayoutWithGrid data={quizzes} imageLogo={quizLogo} image={quizImage} Component={QuizForm} name="Quiz" />
        </>
    )
}

export default ManageQuizzes