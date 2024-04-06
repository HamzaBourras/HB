/* eslint-disable no-unused-vars */
/* eslint-disable react-hooks/exhaustive-deps */
/* eslint-disable react/prop-types */
import { useState, useMemo, useCallback } from "react";
import {
    Table,
    TableHeader,
    TableColumn,
    TableBody,
    TableRow,
    TableCell,
    Input,
    Button,
    DropdownTrigger,
    Dropdown,
    DropdownMenu,
    DropdownItem,
    User,
    Pagination,
    useDisclosure,
    Modal,
    ModalBody,
    ModalContent,
    ModalHeader,
    ModalFooter,
    Spinner
} from "@nextui-org/react";
import { VerticalDotsIcon } from "../VerticalDotsIcon";
import { SearchIcon } from "../SearchIcon";
import { ChevronDownIcon } from "../ChevronDownIcon";
import { capitalize } from "../../utils/utils";
import { PlusIcon } from "../PlusIcon";
import useForm from "../../hooks/useForm";
// --  -- - - --APIs-------- - - - - - - 

import { DELETE_DEPARTMENT_API, DELETE_PROFESSOR_API, DELETE_SECTOR_API, DELETE_STUDENT_API } from "../../api/apis";
import Alert from "../Alert";
import { handleRenderAction } from '../../state/features/Director/directorSlice';
import { useDispatch } from "react-redux";
import CardImage from "../CardImage";
DELETE_SECTOR_API


const TableComponentWithFilter = ({ data, columns, user, Component, imageLogo, title }) => {

    const { isOpen, onOpen, onOpenChange, onClose } = useDisclosure();
    const [selectId, setSelectId] = useState(null);
    const [deleteAction, setDeleteAction] = useState(false);
    const [apiKey, setApiKey] = useState(null);

    const dispatch = useDispatch();

    const handleEdit = (id) => {
        setSelectId(id);
        onOpen();
    };

    const handleDelete = (userId) => {
        // console.log(`Delete ${user} with ID: ${userId}`);
        onOpen();
        setDeleteAction(true)
        switch (user) {
            case 'professor':
                setApiKey(`${DELETE_PROFESSOR_API}/${userId}`)
                break;
            case 'student':
                setApiKey(`${DELETE_STUDENT_API}/${userId}`)
                break;
            case 'sector':
                setApiKey(`${DELETE_SECTOR_API}/${userId}`)
                break;
            case 'department':
                setApiKey(`${DELETE_DEPARTMENT_API}/${userId}`)
                break;

            default:
                break;
        }
    };

    const { handleSubmit, isLoading, errors, message, setMessage } = useForm({}, apiKey, 'delete', false, true)
    // ---------------------------------------------

    const INITIAL_VISIBLE_COLUMNS = [];
    for (let i = 0; i < columns.length; i++) {
        INITIAL_VISIBLE_COLUMNS.push(columns[i].uid)
    }

    const [filterValue, setFilterValue] = useState("");
    const [selectedKeys, setSelectedKeys] = useState(new Set([]));
    const [visibleColumns, setVisibleColumns] = useState(new Set(INITIAL_VISIBLE_COLUMNS));
    const [rowsPerPage, setRowsPerPage] = useState(5);
    const [sortDescriptor, setSortDescriptor] = useState({
        column: "age",
        direction: "ascending",
    });
    const [page, setPage] = useState(1);

    const pages = Math.ceil(data.length / rowsPerPage);
    const hasSearchFilter = Boolean(filterValue);

    const headerColumns = useMemo(() => {
        return visibleColumns === "all" ? columns : columns.filter((column) => visibleColumns.has(column.uid));
    }, [visibleColumns]);

    // ----------------filter using input--------------------
    const filteredItems = useMemo(() => {
        if (!hasSearchFilter) {
            return data;
        }

        const searchValue = filterValue.toLowerCase();

        return data.filter((item) => {
            return columns.some((column) => {
                const cellValue = String(item[column.uid]).toLowerCase();
                return cellValue.includes(searchValue);
            });
        });
    }, [data, columns, filterValue, hasSearchFilter]);

    //----------------------------------------------------------------

    const items = useMemo(() => {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        return filteredItems.slice(start, end);
    }, [page, filteredItems, rowsPerPage]);

    const sortedItems = useMemo(() => {
        return [...items].sort((a, b) => {
            const first = a[sortDescriptor.column];
            const second = b[sortDescriptor.column];
            const cmp = first < second ? -1 : first > second ? 1 : 0;

            return sortDescriptor.direction === "descending" ? -cmp : cmp;
        });
    }, [sortDescriptor, items]);

    const renderCell = useCallback((user, columnKey) => {
        const cellValue = user[columnKey];

        switch (columnKey) {
            case "name":
                return (
                    <User
                        avatarProps={{ radius: "full", size: "sm", src: user.avatar }}
                        classNames={{ description: "text-default-500" }}
                        description={user.email}
                        name={cellValue}
                    >
                        {user.email}
                    </User>
                );
            case "role":
                return (
                    <div className="flex flex-col">
                        <p className="text-bold text-small capitalize">{cellValue}</p>
                        <p className="text-bold text-tiny capitalize text-default-500">{user.team}</p>
                    </div>
                );
            case "actions":
                return (
                    <div className="relative flex justify-end items-center gap-2">
                        <Dropdown
                            aria-label="options"
                            className="bg-background border-1 border-default-200">
                            <DropdownTrigger>
                                <Button isIconOnly radius="full" size="sm" variant="light">
                                    <VerticalDotsIcon className="text-default-400" />
                                </Button>
                            </DropdownTrigger>
                            <DropdownMenu
                                aria-label="options"
                            >
                                <DropdownItem
                                    onClick={() => handleEdit(user.id)}
                                >
                                    Edit</DropdownItem>
                                <DropdownItem
                                    onClick={() => handleDelete(user.id)}
                                >
                                    Delete</DropdownItem>
                            </DropdownMenu>
                        </Dropdown>
                    </div>
                );
            default:
                return cellValue;
        }
    }, []);

    const onRowsPerPageChange = useCallback((e) => {
        setRowsPerPage(Number(e.target.value));
        setPage(1);
    }, []);

    const onSearchChange = useCallback((value) => {
        if (value) {
            setFilterValue(value);
            setPage(1);
        } else {
            setFilterValue("");
        }
    }, []);

    const topContent = useMemo(() => {
        return (
            <div className="flex flex-col gap-4 m-2">
                <CardImage image={imageLogo} title={title} />
                <div className="flex justify-between gap-3 items-center px-3">
                    <Input
                        isClearable
                        className="w-96"
                        classNames={{
                            base: "w-full sm:max-w-[50%]",
                            inputWrapper: "border-1",
                        }}
                        placeholder="Search by name..."
                        size="sm"
                        startContent={<SearchIcon className="text-default-300" />}
                        value={filterValue}
                        variant="bordered"
                        onClear={() => setFilterValue("")}
                        onValueChange={onSearchChange}
                    />
                    <div className="flex gap-3">
                        <Dropdown>
                            <DropdownTrigger className="hidden sm:flex">
                                <Button
                                    endContent={<ChevronDownIcon className="text-small" />}
                                    size="sm"
                                    variant="flat"
                                >
                                    Columns
                                </Button>
                            </DropdownTrigger>
                            <DropdownMenu
                                disallowEmptySelection
                                aria-label="Table Columns"
                                closeOnSelect={false}
                                selectedKeys={visibleColumns}
                                selectionMode="multiple"
                                onSelectionChange={setVisibleColumns}
                            >
                                {columns.map((column) => (
                                    <DropdownItem key={column.uid} className="capitalize">
                                        {capitalize(column.name)}
                                    </DropdownItem>
                                ))}
                            </DropdownMenu>
                        </Dropdown>

                        {user == 'my-students' ? null :
                            <Button
                                onPress={onOpen}
                                className="bg-foreground text-background"
                                endContent={<PlusIcon />}
                                size="sm">Add New
                            </Button>
                        }

                    </div>
                </div>
                <div className="flex justify-between items-center">
                    <span className="text-default-400 text-small">Total {data.length} {user == "my-students" ? "students" : `${user}s`}</span>
                    <label className="flex items-center text-default-400 text-small">
                        Rows per page:
                        <select
                            className="bg-transparent outline-none text-default-400 text-small"
                            onChange={onRowsPerPageChange}
                        >
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                        </select>
                    </label>
                </div>
            </div>
        );
    }, [filterValue, visibleColumns, onSearchChange, onRowsPerPageChange, data.length, hasSearchFilter]);

    // -----------------------------for pagination -----------------------------------------
    const bottomContent = useMemo(() => {
        return (
            <div className="py-2 px-2 flex justify-between items-center">
                <Pagination
                    showControls
                    classNames={{
                        cursor: "bg-foreground text-background",
                    }}
                    color="default"
                    isDisabled={hasSearchFilter}
                    page={page}
                    total={pages}
                    variant="light"
                    onChange={setPage}
                />
            </div>
        );
    }, [selectedKeys, items.length, page, pages, hasSearchFilter]);

    //-----------------------------------------------------------------------------------------

    const classNames = useMemo(() => ({
        wrapper: ["max-h-[382px]", "max-w-3xl"],
        th: ["bg-transparent", "text-default-500", "border-b", "border-divider"],
        td: [
            "group-data-[first=true]:first:before:rounded-none",
            "group-data-[first=true]:last:before:rounded-none",
            "group-data-[middle=true]:before:rounded-none",
            "group-data-[last=true]:first:before:rounded-none",
            "group-data-[last=true]:last:before:rounded-none",
        ],
    }), []);

    return (
        <div>
            <Table
                className='xs:sm:overflow-x-scroll md:lg:overflow-hidden overflow-y-hidden'
                removeWrapper
                aria-label="User Information Table"
                bottomContent={bottomContent}
                bottomContentPlacement="outside"
                checkboxesProps={{
                    classNames: {
                        wrapper: "after:bg-foreground after:text-background text-background",
                    },
                }}
                classNames={classNames}
                selectedKeys={selectedKeys}
                selectionMode="single"
                sortDescriptor={sortDescriptor}
                topContent={topContent}
                topContentPlacement="outside"
                onSelectionChange={setSelectedKeys}
                onSortChange={setSortDescriptor}
            >
                <TableHeader columns={headerColumns}>
                    {(column) => (
                        <TableColumn
                            key={column.uid}
                            align={column.uid === "actions" ? "center" : "start"}
                            allowsSorting={column.sortable}
                        >
                            {column.name}
                        </TableColumn>
                    )}
                </TableHeader>
                <TableBody emptyContent="No data found" items={sortedItems}>
                    {(item) => (
                        <TableRow key={item.id}>
                            {(columnKey) => <TableCell>{renderCell(item, columnKey)}</TableCell>}
                        </TableRow>
                    )}
                </TableBody>
            </Table>

            <div>

                <Modal
                    // size="5xl"
                    isOpen={isOpen}
                    onOpenChange={onOpenChange}
                    onClose={() => {
                        setSelectId(null);
                        setDeleteAction(false);
                        setApiKey(null)
                        onClose();
                        setMessage('')
                        dispatch(handleRenderAction())
                    }}
                    className="overflow-auto p-3"
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
                                <ModalHeader className="flex flex-col gap-1 text-2xl font-medium">
                                    {message && <Alert color="success" message={message} />}
                                    {deleteAction &&
                                        <div>
                                            <h1 className="text-red-500">Delete {user}</h1>
                                            <p className="text-sm text-gray-600">Are you sure you want to delete this {user} ?</p>
                                        </div>
                                    }

                                    {!deleteAction && (
                                        <div>
                                            {!selectId && <h1>Create new {user}</h1>}
                                            {selectId && <h1>Update {user}</h1>}
                                        </div>
                                    )}

                                </ModalHeader>
                                <ModalBody className="">
                                    {deleteAction && <div>
                                    </div>
                                    }
                                    {!deleteAction && (
                                        <div>
                                            <Component id={selectId} />
                                        </div>
                                    )}
                                </ModalBody>
                                <ModalFooter>
                                    {deleteAction &&
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
                                    {!deleteAction && (
                                        <div>
                                        </div>
                                    )}

                                </ModalFooter>
                            </>
                        )}
                    </ModalContent>
                </Modal>


            </div>
        </div>
    );
};

export default TableComponentWithFilter;
