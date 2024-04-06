/* eslint-disable react/prop-types */
/* eslint-disable no-unused-vars */
import { Button, Checkbox, ModalFooter, ModalHeader, Spinner, useDisclosure } from '@nextui-org/react'
import { getArrayById, shuffleArray } from '../../../utils/utils'
import { ModalBody } from '@nextui-org/react';
import { useSelector } from 'react-redux';
import useForm from '../../../hooks/useForm';
import Alert from '../../../components/Alert';
import { SUBMIT_STUDENT_QUIZ_API } from '../../../api/apis';
const StudentQuizForm = ({ id }) => {

    const user = JSON.parse(localStorage.getItem('user'));
    // ------------------------API-----------------------------------------
    let apiKey = `${SUBMIT_STUDENT_QUIZ_API}/${user.id}/${id}`
    // ---------------------------------------------------------------------

    // -------------------------------DATA----------------------------------
    const quizzes = useSelector((state) => state.student.quizzes);
    const quiz = getArrayById(quizzes, 'id', id)[0];

    const initialState = {
        quizName: id ? quiz['quizName'] : '',
        sector: id ? quiz['sector'] : '',
        questions: id ? quiz['questions'] : [],
    };

    const { inputs, errors, message, isLoading, handleChange, handleSubmit } = useForm(initialState, apiKey, 'post', false, true);

    const handleCheckboxChange = (e, questionIndex, answerIndex) => {
        const updatedQuestions = [...inputs.questions];
        const updatedAnswers = [...updatedQuestions[questionIndex].answers]; // Create a copy of answers array
        updatedAnswers[answerIndex] = { ...updatedAnswers[answerIndex], isCorrect: e.target.checked }; // Update the copied answer object
        updatedQuestions[questionIndex] = { ...updatedQuestions[questionIndex], answers: updatedAnswers }; // Update the copied question object with the modified answers array
        handleChange('questions', updatedQuestions); // Update the state with the modified questions array
    };

    const { onClose } = useDisclosure();

    return (
        <div className='my-3'>
            {message && <Alert color='success' message={message} />}
            <form onSubmit={handleSubmit} >
                <div className='h-full flex flex-col'>
                    <ModalHeader className='text-2xl'>
                        {quiz && quiz.quizName} Quiz
                    </ModalHeader>
                    <ModalBody className='flex-1'>
                        {quiz && quiz.questions && quiz.questions.map((question, index) => (
                            <div key={index}>
                                <p>
                                    <span className='font-bold text-lg'>Question {index + 1}: </span>
                                    {question.question} <span className='font-semibold ml-2'>({question.note} pts)</span>
                                </p>
                                <ul>
                                    {(question.answers).map((answer, answerIndex) => (
                                        <li key={answerIndex}>
                                            <div className='ml-4 flex items-center'>
                                                <Checkbox
                                                    color='primary'
                                                    size="md"
                                                    onChange={(e) => handleCheckboxChange(e, index, answerIndex)}
                                                />
                                                {answer.answer}
                                            </div>
                                        </li>
                                    ))}
                                </ul>
                            </div>
                        ))}
                    </ModalBody>
                    <ModalFooter>
                        <Button
                            type='submit'
                            className='bg-foreground text-background'
                            onClick={handleSubmit} disabled={isLoading}>
                            {isLoading ? (<div className='flex items-center gap-1'><Spinner size='sm' color="default" />Submitting...</div>) : "Submit"}
                        </Button>
                    </ModalFooter>
                </div>
            </form>
        </div>
    )
}
export default StudentQuizForm