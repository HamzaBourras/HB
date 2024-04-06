import home from '../../assets/icons/home.svg';
import department  from '../../assets/icons/department.svg';
import teachers from '../../assets/icons/teachers.svg';
import sector from '../../assets/icons/sector.svg';
import accounts from '../../assets/icons/accounts.svg';
import students from '../../assets/icons/student.svg';

const Tabs = [
    {
        id: 1,
        name: "Dashboard",
        icon: home,
        path: "/auth/director/dashboard"
    },
    {
        id: 2,
        name: "Professors",
        icon: teachers,
        path: "/auth/director/professors"
    },
    {
        id: 5,
        name: "Students",
        icon: students,
        path: "/auth/director/students"
    },
    {
        id: 3,
        name: "Departments",
        icon: department,
        path: "/auth/director/departments"
    },
    {
        id: 4,
        name: "Sectors",
        icon: sector,
        path: "/auth/director/sectors"
    },
    // {
    //     id: 6,
    //     name: "Accounts",
    //     icon: accounts,
    //     path: "/auth/director/accounts",
    // },
    
];



export default Tabs;
