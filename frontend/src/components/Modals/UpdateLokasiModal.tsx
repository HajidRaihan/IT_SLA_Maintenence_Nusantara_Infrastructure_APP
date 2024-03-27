import React from "react";
import { Modal, ModalContent, ModalHeader, ModalBody, ModalFooter, Button, Input } from "@nextui-org/react";

function UpdateLokasiModal({ isUpdateOpen, onUpdateClose, onAdd, value, onChange }) {
  return (
    <>
      <Modal isOpen={isUpdateOpen} onClose={onUpdateClose} placement="top-center">
        <ModalContent>
          <>
            <ModalHeader className="flex flex-col gap-1">Update Lokasi</ModalHeader>
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
              <Button color="danger" variant="flat" onPress={onUpdateClose}>
                Close
              </Button>
              <Button color="primary" onPress={onAdd}>
                Update
              </Button>
            </ModalFooter>
          </>
        </ModalContent>
      </Modal>
    </>
  );
}

export default UpdateLokasiModal;
