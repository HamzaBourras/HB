/* eslint-disable no-unused-vars */
/* eslint-disable react/prop-types */
import { Badge, Button, Dropdown, DropdownItem, DropdownMenu, DropdownTrigger } from '@nextui-org/react';
import { NotificationIcon } from './NotificationIcon';
export const NotificationComponent = ({ notifications }) => {
    return (
        <div>
            <div>
                <Dropdown
                    placement="bottom-end"
                    radius='none'
                >
                    <DropdownTrigger
                        
                    >
                        <Button
                            size="md"
                            radius="sm"
                            isIconOnly
                            aria-label="notifications"
                            variant=""
                            className="relative"
                        >
                            {
                                (notifications.length) > 0 ? 
                                (<Badge
                                content={notifications.length}
                                shape="rectangle"
                                color="danger"
                                className='absolute left-1 -top-2'
                                />):
                                <></>
                            }
                            <NotificationIcon />
                        </Button>

                    </DropdownTrigger>
                    <DropdownMenu
                        aria-label="Notifications"
                        variant="faded"
                        className=''
                    >
                        {
                            notifications.map(notification => (
                                <DropdownItem
                                    key={notification.id}
                                    isReadOnly
                                >
                                    <div className='flex flex-col px-3 rounded group'>
                                        <span className='font-medium text-sm text-blue-600'>Professor: <p className='inline text-black font-normal'>{notification.professorName}</p></span>
                                        <p className='line-clamp-1 group-hover:line-clamp-none w-52 text-pretty'>
                                            {notification.announcement}
                                        </p>
                                    </div>
                                </DropdownItem>
                            ))
                        }


                    </DropdownMenu>
                </Dropdown>
            </div>
        </div>
    );
};
