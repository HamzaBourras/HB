/* eslint-disable no-unused-vars */
import Sidebar from "../../components/sidebar/Sidebar";
import { Navigate, Outlet } from 'react-router-dom'
import ProfessorStructure from '../../components/sidebar/ProfessorStructure';
import { useDispatch, useSelector } from "react-redux";
import { useEffect } from "react";
import { ALL_ANNOUNCEMENTS_API, ALL_COURSES_API, ALL_QUIZZES_API, ALL_TASKS_API, GET_PROFESSOR_STATISTICS_API, PROFESSOR_STUDENTS_API } from "../../api/apis";
import useFetch from "../../hooks/useFetch";
import LoadingPage from "../../components/LoadingPage";
import { saveAnnouncements, saveCourses, saveMyStudents, saveQuizzes, saveTasks } from "../../state/features/Professor/professorSlice";
import Alert from './../../components/Alert';
import { saveStaticstics } from "../../state/features/Professor/professorSlice";


const ProfessorLayout = () => {

    const user = JSON.parse(localStorage.getItem('user'));

    const dispatch = useDispatch();
    const reRender = useSelector((state) => state.professor.renderAction);

    const { data: studentsData, isLoading: studentsLoading, error: studentsError } = useFetch(`${PROFESSOR_STUDENTS_API}/${user.id}`, reRender);
    const { data: coursesData, isLoading: coursesLoading, error: coursesError } = useFetch(`${ALL_COURSES_API}/${user.id}`, reRender, true);
    const { data: announcementsData, isLoading: announcementsLoading, error: announcementsError } = useFetch(`${ALL_ANNOUNCEMENTS_API}/${user.id}`, reRender);
    const { data: quizzesData, isLoading: quizzesLoading, error: quizzesError } = useFetch(`${ALL_QUIZZES_API}/${user.id}`, reRender);
    const { data: taskData, isLoading: taskLoading, error: taskError } = useFetch(`${ALL_TASKS_API}/${user.id}`, reRender);
    const { data: staticsticsData, isLoading: staticsticsLoading, error: staticsticsError } = useFetch(`${GET_PROFESSOR_STATISTICS_API}/${user.id}`, reRender);


    useEffect(() => {

        if (studentsData) {
            dispatch(saveMyStudents(studentsData.data));
        }
        if (coursesData) {
            dispatch(saveCourses(coursesData.data));
        }

        if (announcementsData) {
            dispatch(saveAnnouncements(announcementsData.data));
        }

        if (quizzesData) {
            dispatch(saveQuizzes(quizzesData.data));
        }

        if (taskData) {
            dispatch(saveTasks(taskData.data));
        }

        if (staticsticsData) {
            dispatch(saveStaticstics(staticsticsData.data));
        }

    }, [studentsData, reRender, coursesData, dispatch, announcementsData, quizzesData, staticsticsData ,taskData]);


    if ((user.role) !== 'professor') {
        return <Navigate to={`/auth/${user.role}`} replace />;
    }

    return (
        <div className='flex relative animate-appearance-in transition-all duration-300 delay-300 transform'>
            <div className='grow-0'>
                <Sidebar tabs={ProfessorStructure} user="professor" />
            </div>
            <div className='grow shrink xs:sm:ml-24 mr-3 md:lg:ml-56 py-3 overflow-hidden'>
                <div>
                    {(studentsLoading || coursesLoading) && <LoadingPage />}
                </div>
                <div className='md:lg:mx-40'>
                    <Outlet />
                </div>
            </div>
        </div>
    )
}

export default ProfessorLayout;