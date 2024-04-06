/* eslint-disable react/prop-types */
import Paper from '@mui/material/Paper';
import { ViewState } from '@devexpress/dx-react-scheduler';
import {
    Scheduler,
    WeekView,
    Appointments,
} from '@devexpress/dx-react-scheduler-material-ui';
import { appointments } from '../json/data';


const currentDate = '2018-06-27';



const CalendarComponent = () => (
    <div className='h-36 overflow-y-auto border rounded-md'>
        <Paper>
            <Scheduler
                data={appointments}
            >
                <ViewState
                    defaultCurrentDate={currentDate}
                />
                <WeekView

                    startDayHour={9}
                    endDayHour={18}

                />
                <Appointments />
            </Scheduler>
        </Paper>
    </div>
);

export default CalendarComponent;