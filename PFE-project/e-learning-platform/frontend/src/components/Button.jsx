/* eslint-disable react/prop-types */
import { PlusIcon } from "./PlusIcon"
import { Button } from "@nextui-org/react";

const Btn = ({onOpen, children}) => {
    return (
        <Button onPress={onOpen} className="bg-foreground text-background" endContent={<PlusIcon />} size="sm">{ children }</Button>
    )
}

export default Btn
