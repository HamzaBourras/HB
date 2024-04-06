/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable no-unused-vars */
import { countData, getRecentlyAddedData } from "../../utils/utils";
import { useEffect, useState } from "react";
import BarChart from '../../components/BarChart';
import ProgressComponent from "../../components/ProgressComponent";
// images
import ProfImage from '../../assets/images/teacher.png'
import StudentImage from '../../assets/images/student-logo.png'
import DepartmentImage from '../../assets/images/department.png'
import SectorImage from '../../assets/images/sector.png'
import { useSelector } from "react-redux";
import { COLORS } from './../../../constants/COLORS';
import WelcomeBanner from './../../components/WelcomeBanner';
import ColumnChart from './../../components/ColumnChart';



const DirectorDashboard = () => {

    const user = JSON.parse(localStorage.getItem('user'));

    const professors = useSelector((state) => state.director.professors);
    const students = useSelector((state) => state.director.students);
    const departments = useSelector((state) => state.director.departments);
    const sectors = useSelector((state) => state.director.sectors);

    const [professorCounter, setProfessorCounter] = useState(0);
    const [studentCounter, setStudentCounter] = useState(0);
    const [departmentCounter, setDepartmentCounter] = useState(0);
    const [sectorCounter, setSectorCounter] = useState(0);

    const updateData = () => {
        setProfessorCounter(countData(professors))
        setStudentCounter(countData(students))
        setDepartmentCounter(countData(departments))
        setSectorCounter(countData(sectors))
    }

    useEffect(()=>{
        if (professors && students && departments && sectors) {
            updateData()
        }

    },[professors, students, departments, sectors])

    // const recentStudents = getRecentlyAddedData(students, "id", 3);


    const staticstics = useSelector((state)=> state.director.staticstics)

    const professorData = staticstics ;

    // --- -- - -- - - - - - - -- - -- - -- - - - - - - - - -- - - - -  -- - - - - - - - - - - - - -- - -- -  - -
    return (
        <div className="space-y-3">
            
            <WelcomeBanner user={user.firstName}/>
            <div className="grid xs:sm:grid-cols-2 md:lg:grid-cols-4 gap-2">

                <ProgressComponent  name="Professors" image={ProfImage} number={professorCounter} maxNumber={15} color="secondary" />

                <ProgressComponent  name="Students" image={StudentImage} number={studentCounter} maxNumber={40} color="secondary" />

                <ProgressComponent  name="Departments" image={DepartmentImage} number={departmentCounter} maxNumber={10} color="secondary" />

                <ProgressComponent  name="Sectors" image={SectorImage} number={sectorCounter} maxNumber={15} color="secondary" />


            </div>

            <div>
                <h1 className="font-medium">Active Professors</h1>
                <BarChart data={professorData} labels={['assignments', 'quizzes', 'courses']} colors={COLORS} />
                {/* <ColumnChart /> */}
            </div>
            {/* <div className="space-y-2">
                <h1>Recentaly added students</h1>
                <div>
                    <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead className="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th scope="col" className="px-6 py-3">
                                    Firstname
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Lastname
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Sector
                                </th>
                                <th scope="col" className="px-6 py-3">
                                    Department
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {
                                recentStudents.map(i => (
                                    <tr key={i.id} className="bg-white border-b hover:bg-gray-50">
                                        <td className="px-6 py-4">
                                            {i.firstname}
                                        </td>
                                        <td className="px-6 py-4">
                                            {i.lastname}
                                        </td>
                                        <td className="px-6 py-4">
                                            {i.sector}
                                        </td>
                                        <td className="px-6 py-4">
                                            {i.department}
                                        </td>
                                    </tr>
                                ))
                            }
                        </tbody>
                    </table>
                </div>
            </div> */}
        </div>
    );
}

export default DirectorDashboard;
