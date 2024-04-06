import home from '../../assets/icons/home.svg';
import tasks from '../../assets/icons/tasks.svg';
import books from '../../assets/icons/books.svg';
import students from '../../assets/icons/student.svg';
import announcements from '../../assets/icons/announcements.svg';
import quizzes from '../../assets/icons/quizzes.svg';
import meeting from '../../assets/icons/meeting.svg';

const Tabs = [
    {
        id: 1,
        name: "Dashboard",
        icon: home,
        path: "/auth/professor/dashboard"
    },
    {
        id: 2,
        name: "Courses",
        icon: books,
        path: "/auth/professor/courses"
    },
    {
        id: 3,
        name: "My Students",
        icon: students,
        path: "/auth/professor/my-students"
    },
    {
        id: 4,
        name: "Announcments",
        icon: announcements,
        path: "/auth/professor/announcements"
    },
    {
        id: 5,
        name: "Quizzes",
        icon: quizzes,
        path: "/auth/professor/quizzes"
    },
    {
        id: 6,
        name: "tasks",
        icon: tasks,
        path: "/auth/professor/tasks"
    },

    
];

export default Tabs;
