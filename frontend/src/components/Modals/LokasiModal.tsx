import React from "react";
import { Modal, ModalContent, ModalHeader, ModalBody, ModalFooter, Button, Input } from "@nextui-org/react";

function LokasiModal({ isOpen, onClose, onAdd, value, onChange }) {
  return (
    <>
      <Modal isOpen={isOpen} onClose={onClose} placement="top-center">
        <ModalContent>
          <>
            <ModalHeader className="flex flex-col gap-1">Add Lokasi</ModalHeader>
            <ModalBody>
              <Input
                autoFocus
                value={value}
                onChange={onChange}
                label="Lokasi"
                placeholder="Enter your lokasi"
                variant="bordered"
              />
            </ModalBody>
            <ModalFooter>
              <Button color="danger" variant="flat" onPress={onClose}>
                Close
              </Button>
              <Button color="primary" onPress={onAdd}>
                Add
              </Button>
            </ModalFooter>
          </>
        </ModalContent>
      </Modal>
    </>
  );
}

export default LokasiModal;
