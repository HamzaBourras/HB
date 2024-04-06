import { useSelector } from 'react-redux';
import TableComponentWithFilter from '../../components/Table/TableComponentWithFilter';
import { sectorsColumns } from '../../json/data'
import SectorForm from "./components/SectorForm";
import SectorImage from '../../assets/images/sector.png'


export default function ManageSectors() {
    const sectors = useSelector((state) => state.director.sectors)
    return (
        <div>
            <TableComponentWithFilter imageLogo={SectorImage} Component={SectorForm} data={sectors} columns={sectorsColumns} title="Sectors" user="sector" />
        </div>
    )
}
