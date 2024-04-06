import home from '../../assets/icons/home.svg';
import submission from '../../assets/icons/submission.png';
import grade from '../../assets/icons/grade.svg';
import books from '../../assets/icons/books.svg';
import quizzes from '../../assets/icons/quizzes.svg';
import meeting from '../../assets/icons/meeting.svg';

const Tabs = [
    {
        id: 1,
        name: "Home",
        icon: home,
        path: "/auth/student/dashboard"
    },
    {
        id: 6,
        name: "Courses",
        icon: books,
        path: "/auth/student/courses"
    },
    {
        id: 2,
        name: "My grades",
        icon: grade,
        path: "/auth/student/grades"
    },
    {
        id: 5,
        name: "Quizzes",
        icon: quizzes,
        path: "/auth/student/quizzes"
    },
    {
        id: 4,
        name: "Tasks",
        icon: submission,
        path: "/auth/student/submissions"
    },


];

export default Tabs;
