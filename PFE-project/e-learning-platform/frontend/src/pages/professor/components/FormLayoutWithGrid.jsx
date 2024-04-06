/* eslint-disable react/prop-types */
/* eslint-disable no-unused-vars */
import { Modal, ModalContent, ModalHeader, ModalBody, Divider, ModalFooter, useDisclosure, ButtonGroup, Button, Tab, Tabs, Card, CardBody, Spinner, Chip } from "@nextui-org/react";
import { useState } from 'react';
import grid from '../../../assets/icons/gridSQ.svg'
import list from '../../../assets/icons/grid_list.svg'
import remove from '../../../assets/icons/delete.svg'
import edit from '../../../assets/icons/edit.svg'
import view from '../../../assets/icons/eye.svg'

import { PlusIcon } from '../../../components/PlusIcon';
import { getArrayById, uncapitalize } from "../../../utils/utils";
import { useDispatch } from "react-redux";
import { handleRenderAction } from "../../../state/features/Professor/professorSlice";
import useForm from "../../../hooks/useForm";
import { DELETE_ANNOUNCEMENT_API, DELETE_COURSE_API, DELETE_QUIZ_API, DELETE_TASK_API } from "../../../api/apis";
import Alert from "../../../components/Alert";
import CardImage from "../../../components/CardImage";
import { Navigate, useNavigate } from "react-router";


const FormLayoutWithGrid = ({ data, image, imageLogo, Component, name }) => {

    const user = JSON.parse(localStorage.getItem('user'));

    const { isOpen, onOpen, onOpenChange, onClose } = useDisclosure();
    const [isGrid, setIsGrid] = useState(name == "Announcement" || name == "Students" ? false : true);
    const [selectedId, setSelectedId] = useState(null);

    const [selectedKey, setSelectedKey] = useState('')
    const [deleteClicked, setDeleteClicked] = useState(false)


    const sectors = JSON.parse(localStorage.getItem('user')).sectors
    const filteredData = getArrayById(data, 'sector', selectedKey)
    const dispatch = useDispatch()

    const openForm = (id = null) => {
        setSelectedId(id);
        onOpen();
    };

    const [apiKey, setApiKey] = useState(null)


    const handleDelete = (id) => {
        setSelectedId(id);
        setDeleteClicked(true);
        onOpen();

        switch (uncapitalize(name)) {
            case "course":
                setApiKey(`${DELETE_COURSE_API}/${user.id}/${id}`)
                break;

            case "announcement":
                setApiKey(`${DELETE_ANNOUNCEMENT_API}/${user.id}/${id}`)
                break;

            case "quiz":
                setApiKey(`${DELETE_QUIZ_API}/${user.id}/${id}`)
                break;
            case "task":
                setApiKey(`${DELETE_TASK_API}/${user.id}/${id}`)
                break;

            default:
                break;
        }
    }

    const navigate = useNavigate()
    const showResult = (id) => {
        return navigate(`/auth/professor/result/${uncapitalize(name)}/${id}`, {
            replace: true,
        })
    }


    const { handleSubmit, isLoading, errors, message, setMessage } = useForm({}, apiKey, 'delete', false, true)
    return (
        <div className="space-y-2 m-2">
            <CardImage image={imageLogo} title={name == "Quiz" ? "Quizzes" : `${name}s`} />
            <Divider />
            <div className='flex justify-end gap-1'>
                <ButtonGroup size='sm' radius='sm' variant='bordered'>
                    <Button onClick={() => setIsGrid(true)} color="default">
                        <img src={grid} className='w-4' alt="Grid Icon" />
                    </Button>
                    <Button onClick={() => setIsGrid(false)}>
                        <img src={list} className='w-5' alt="Grid Icon" />
                    </Button>
                </ButtonGroup>
                <Button
                    onPress={onOpen}
                    className="bg-foreground text-background"
                    endContent={<PlusIcon />}
                    size="sm">Create {name}</Button>
            </div>
            <Modal
                // size="5xl"
                isOpen={isOpen}
                scrollBehavior="inside"
                onOpenChange={onOpenChange}
                onClose={() => {
                    setSelectedId(null);
                    onClose();
                    dispatch(handleRenderAction())
                    setDeleteClicked(false)
                    setMessage(null)
                }}
                className="overflow-auto"
                motionProps={{
                    variants: {
                        enter: {
                            y: 0,
                            opacity: 1,
                            transition: {
                                duration: 0.3,
                                ease: "easeOut",
                            },
                        },
                        exit: {
                            y: -20,
                            opacity: 0,
                            transition: {
                                duration: 0.2,
                                ease: "easeIn",
                            },
                        },
                    }
                }}
            >
                <ModalContent>
                    {(onClose) => (
                        <>
                            <ModalHeader className="text-center">{selectedId ? deleteClicked ? "Delete" : 'Update' : 'Create'} {name}</ModalHeader>
                            <div className="px-3">
                                {message && <Alert color="success" message={message} />}
                            </div>
                            <ModalBody>
                                {!deleteClicked && <Component id={selectedId} />}

                                {deleteClicked && <div>
                                    <p className="text-sm text-gray-600">Are you sure you want to delete this {name} ?</p>

                                </div>}
                            </ModalBody>
                            <ModalFooter>
                                {deleteClicked &&
                                    <div className="space-x-2 flex">
                                        <Button variant="faded" onPress={onClose}>
                                            Cancel
                                        </Button>
                                        <Button
                                            color="danger"
                                            variant="solid"
                                            onClick={handleSubmit}
                                            isDisabled={isLoading}
                                        >
                                            {isLoading ? (<div className='flex items-center gap-1'><Spinner color="white" /> Loading...</div>) : 'Delete'}
                                        </Button>
                                    </div>
                                }
                                {!deleteClicked && (
                                    <></>
                                )}

                            </ModalFooter>
                        </>
                    )}
                </ModalContent>
            </Modal>
            <Divider />
            <div className="flex w-full flex-col">
                <Tabs
                    aria-label="Dynamic tabs"
                    items={sectors}
                    variant='underlined'
                    selectedKey={selectedKey}
                    onSelectionChange={setSelectedKey}
                >
                    {sectors.map((sector, index) => (
                        <Tab
                            key={sector}
                            title={
                                <span>{sector}</span>
                            }
                        >
                        </Tab>
                    ))}
                </Tabs>
            </div>
            <div className={`grid ${isGrid ? 'xs:grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7' : ''} gap-2`}>
                {
                    filteredData && filteredData.length > 0 ?
                        (filteredData.map(item => (
                            <div
                                key={item.id}
                                className={`flex group animate-appearance-in p-3 ${isGrid ? 'flex-col justify-center items-center text-center' : 'items-center'} hover:cursor-pointer hover:bg-gray-50 rounded-md border`}>
                                <img src={image} className='w-12' />

                                <div className={`flex items-center ${isGrid ? 'flex-col space-y-1 h-full' : ''} w-full`}>
                                    <h1 className='text-sm font-medium text-balance flex-1 text-gray-500'>{item[uncapitalize(name) + 'Name']}</h1>
                                    <div className="space-x-1 hidden group-hover:flex group-hover:animate-appearance-in group-hover:transform group-hover:transition-all group-hover:delay-500 transition duration-400 ease-in-out">
                                        {(name === "Task" || name === "Quiz" || name === "Course") && (
                                            name === "Course" ? (
                                                <Button
                                                    variant="solid"
                                                    isIconOnly
                                                    color="primary"
                                                    size="sm"
                                                >
                                                    <a
                                                        href={`http://localhost:8000${item.file}`}
                                                        download
                                                        target="_blank"
                                                        rel="noreferrer"
                                                    >
                                                        <img
                                                            src={view}
                                                            className="size-4 invert"
                                                            alt="Download"
                                                        />
                                                    </a>
                                                </Button>
                                            ) : (
                                                <Button
                                                    variant="solid"
                                                    isIconOnly
                                                    color="primary"
                                                    size="sm"
                                                    onClick={() => showResult(item.id)}
                                                >
                                                    <img
                                                        src={view}
                                                        className="size-4 invert"
                                                        alt="View"
                                                    />
                                                </Button>
                                            )
                                        )}

                                        <Button
                                            variant="solid"
                                            isIconOnly
                                            color="warning"
                                            size="sm"
                                            onClick={() => openForm(item.id)}
                                        >
                                            <img
                                                src={edit}
                                                className="size-4 invert"
                                            />
                                        </Button>
                                        <Button
                                            variant="solid"
                                            isIconOnly
                                            color="danger"
                                            size="sm"
                                            onClick={() => handleDelete(item.id)}
                                        >
                                            <img
                                                src={remove}
                                                className="size-4 invert"
                                            />
                                        </Button>
                                    </div>
                                </div>
                            </div>
                        )))
                        :
                        <h1 className="w-full col-span-2 mx-4 text-gray-600">No {name == "Quiz" ? "Quizzes" : `${name}s`} at the moment</h1>
                }
            </div>
        </div>
    )
}

export default FormLayoutWithGrid