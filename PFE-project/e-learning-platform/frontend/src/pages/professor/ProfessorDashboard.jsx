// import { students, courses } from '../../json/data'
import StduentImage from '../../assets/images/student-logo.png'
import CourseImage from '../../assets/images/folder-Logo.png'
import QuizImage from '../../assets/images/quizLogo.png'
import BarChart from '../../components/BarChart'
import { countData } from './../../utils/utils';
import ProgressComponent from './../../components/ProgressComponent';
import { COLORS } from './../../../constants/COLORS';
import WelcomeBanner from './../../components/WelcomeBanner';
import { useSelector } from 'react-redux';

const ProfessorDashboard = () => {
    // ------------------Data-------------------------------
    const authUser = JSON.parse(localStorage.getItem('user'));
    const students = useSelector((state) => state.professor.myStudents)
    const courses = useSelector((state) => state.professor.courses)
    const quizzes = useSelector((state)=> state.professor.quizzes)

    const staticstics = useSelector((state)=> state.professor.staticstics)

    const studentsData = staticstics

    return (
        <div className="space-y-3">
            <WelcomeBanner user={authUser.firstName} />

            <div className="grid xs:sm:grid-cols-2 md:lg:grid-cols-2 gap-4 h-fit">
                <ProgressComponent name="Students" image={StduentImage} number={countData(students)} maxNumber={60} />
                <ProgressComponent name="Courses" image={CourseImage} number={countData(courses)} maxNumber={20} />
                <div className="col-span-2">
                    <ProgressComponent name="Quizzes" image={QuizImage} number={countData(quizzes)} maxNumber={80} />
                </div>
            </div>

            <div className='flex flex-col items-center'>

                <div className='boreder w-full space-y-2'>
                    <h1 className='font-medium text-gray-500'>Active Students</h1>
                    <BarChart data={studentsData} labels={['assignments', 'quizzes']} colors={COLORS} />
                </div>

                {/* <div className='boreder w-full space-y-2 flex flex-col items-center'>
                    <h1 className='font-medium text-gray-500 self-start'>Downloaded Courses</h1>
                    {downloads.length > 0 ?

                        (<DoughnutChart labels={labels} data={downloads} colors={COLORS} />) :
                        <h1 className="w-full col-span-2 mx-4 text-gray-600">No data was found</h1>
                    }
                </div> */}
            </div>
        </div>
    )
}

export default ProfessorDashboard