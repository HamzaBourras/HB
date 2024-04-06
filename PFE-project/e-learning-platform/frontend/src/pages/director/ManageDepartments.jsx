
import { useSelector } from 'react-redux';
import TableComponentWithFilter from '../../components/Table/TableComponentWithFilter';

import { depatmentsColumns } from '../../json/data'
import DepartmentForm from './components/DepartmentForm'
import departmentImage from '../../assets/images/department.png';


export default function App() {
    const departments = useSelector((state) => state.director.departments)

    return (
        <div>
            <TableComponentWithFilter imageLogo={departmentImage} Component={DepartmentForm} data={departments} columns={depatmentsColumns} title="Departments" user="department" />
        </div>
    )
}
