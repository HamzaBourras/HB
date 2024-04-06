
import { Divider } from '@nextui-org/react';
import ProgressComponent from '../../components/ProgressComponent';
import DoneHW from '../../assets/images/done.png'
import taskImage from '../../assets/images/assignment.png'
import WelcomeBanner from './../../components/WelcomeBanner';
import Card from './components/Card';
import courseImage from '../../assets/images/file.png'
import RadarChart from './../../components/RadarChart';
import CardImage from './../../components/CardImage'
import { useSelector } from 'react-redux';
import { NotificationComponent } from './../../components/NotificationComponent';
import { countData, getArrayById } from './../../utils/utils';


const StudentDashboard = () => {
    const authUser = JSON.parse(localStorage.getItem('user'));
    const myProfessors = useSelector((state) => state.student.myProfessors)
    const courses = useSelector((state) => state.student.courses)

    const someCourses = courses.slice(0, 3)

    const announcements = useSelector((state) => state.student.announcements)
    const latestAnnoucements = announcements.slice(0, 4)

    const tasks = useSelector((state) => state.student.tasks)
    const doneTasks = getArrayById(tasks, 'submitted', true)
    const quizzes = useSelector((state) => state.student.quizzes)

    const doneQuizzs = getArrayById(quizzes, 'isDone', 'true')
    const grades = useSelector((state) => state.student.grades)


    console.log(announcements);

    return (
        <div>
            <WelcomeBanner user={authUser.firstName}>
                <NotificationComponent notifications={latestAnnoucements} />
            </WelcomeBanner>
            <Divider />
            <div className='grid xs:sm:grid-cols-1 md:lg:grid-cols-12 py-1 gap-3'>
                <div className="col-span-9 space-y-3">
                    <h1 className='title'>Summary Report</h1>
                    <div className="grid xs:sm:grid-cols-2 md:lg:grid-cols-2 gap-4 h-fit">
                        <ProgressComponent name="Done Quizzes" image={DoneHW} number={countData(doneQuizzs)} maxNumber={countData(quizzes)} />
                        <ProgressComponent name="Done Tasks" image={taskImage} number={countData(doneTasks)} maxNumber={countData(tasks)} />
                        <div className="col-span-2">
                            <ProgressComponent name="Total Courses" image={courseImage} number={countData(courses)} maxNumber={countData(courses)} />
                        </div>
                    </div>
                    <div className='flex flex-col items-center'>
                        <h1 className='title self-start'>Grades Report</h1>
                        {
                            grades.length > 0 ? (<RadarChart data={grades} />) :
                                (
                                    <h1
                                        className='mt-5 border text-gray-800 border-blue-400 bg-blue-50 py-3 px-3 rounded-md '
                                    >
                                        Your grade statistics will be shown after you pass a quiz
                                    </h1>
                                )
                        }


                    </div>

                </div>

                <div className="h-svh col-span-3 xs:sm:hidden md:lg:flex border-l-1 px-3 flex flex-col space-y-3">

                    <h1 className='title'>My Professors</h1>
                    {
                        myProfessors.map(professor => (
                            <Card
                                key={professor.id}
                                title={`${professor.firstname} ${professor.lastname}`}
                                email={professor.email}
                            />
                        ))
                    }
                    <Divider />
                    <h1 className='title'>Latest courses</h1>
                    {
                        someCourses.map(course => (
                            <CardImage
                                key={course.id}
                                title={course.courseName}
                                image={courseImage}
                                size="10"
                            />
                        ))
                    }

                </div>
            </div>
        </div>
    )
}
export default StudentDashboard