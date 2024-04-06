/* eslint-disable no-unused-vars */
import { Navigate, Outlet } from "react-router"
import Sidebar from "../../components/sidebar/Sidebar"
import StudentStructure from '../../components/sidebar/StudentStructure';

import { useDispatch, useSelector } from 'react-redux';
import { useEffect } from "react";
import useFetch from "../../hooks/useFetch";
import { ALL_STUDENT_QUIZZES_API, ALL_SUBMISSIONS_API, MY_PROFESSORS_API, STUDENT_ANNOUNCEMENTS_API, STUDENT_COURSES_API, STUDENT_GRADES_API } from './../../api/apis';
import { saveAnnouncements, saveCourses, saveGrades, saveMyProfessors, saveQuizzes, saveTasks } from "../../state/features/Student/studentSlice";
import LoadingPage from "../../components/LoadingPage";

const StudentLayout = () => {
    // get the user from local storage
    const user = JSON.parse(localStorage.getItem('user'))

    const dispatch = useDispatch()
    // indecator of modification in data
    const reRender = useSelector((state) => state.student.renderAction);

    // fetch data and store them in redux store
    const { data: myProfessorsData, isLoading: myProfessorsLoading } = useFetch(`${MY_PROFESSORS_API}/${user.id}`, reRender)
    const { data: studentCoursesData, isLoading:studentCourseLoading  } = useFetch(`${STUDENT_COURSES_API}/${user.id}`, reRender)
    const { data: studentQuizzesData, isLoading:studentQuizzesLoading  } = useFetch(`${ALL_STUDENT_QUIZZES_API}/${user.id}`, reRender)
    const { data: studentGradesData, isLoading:studentGradesLoading  } = useFetch(`${STUDENT_GRADES_API}/${user.id}`, reRender)

    const { data: studentTasksData, isLoading:studentTasksLoading  } = useFetch(`${ALL_SUBMISSIONS_API}/${user.id}`, reRender)
    const { data: studentAnnouncementsData, isLoading:studentAnnouncementssLoading  } = useFetch(`${STUDENT_ANNOUNCEMENTS_API}/${user.id}`, reRender)
    
    useEffect(() => {
        // save professors in redux store
        if (myProfessorsData) {
            dispatch(saveMyProfessors(myProfessorsData.data))
        }

        if (studentCoursesData) {
            dispatch(saveCourses(studentCoursesData.data))
        }

        if (studentQuizzesData) {
            dispatch(saveQuizzes(studentQuizzesData.data))
        }

        if (studentGradesData) {
            dispatch(saveGrades(studentGradesData.data))
        }

        if (studentTasksData) {
            dispatch(saveTasks(studentTasksData.data))
        }

        if (studentAnnouncementsData) {
            dispatch(saveAnnouncements(studentAnnouncementsData.data))
        }


    }, [myProfessorsData, studentCoursesData, studentQuizzesData, studentAnnouncementsData , studentTasksData ,studentGradesData ,reRender, dispatch])


    if (user.role !== 'student') {
        return <Navigate to={`/auth/${user.role}`} replace />;
    }

    return (
        <div className='flex'>
            <div className='grow-0'>
                <Sidebar tabs={StudentStructure} user="student" />
            </div>
            <div className='grow shrink xs:sm:ml-24 mr-3 md:lg:ml-56 py-3 overflow-hidden'>
                <div>
                    {(myProfessorsLoading || studentCourseLoading || studentQuizzesLoading) && <LoadingPage />}
                </div>
                <div className='md:lg:mx-40'>
                    <Outlet />
                </div>
            </div>
        </div>
    )
}

export default StudentLayout