import React from "react";
import { Modal, ModalContent, ModalHeader, ModalBody, Button } from "@nextui-org/react";

function VerifiedModal({ isVerifiedOpen, onVerifiedClose, onComplete, onProcess, onNotDone }) {
  return (
    <>
      <Modal isOpen={isVerifiedOpen} onClose={onVerifiedClose} placement="top-center">
        <ModalContent>
          <>
            <ModalHeader className="flex flex-col gap-1">Delete Data</ModalHeader>
            <ModalBody>
            <Button color="primary" variant="flat" onPress={onComplete}>
                Complete
              </Button>
              <Button color="warning" onPress={onProcess}>
                Process
              </Button>
              <Button color="danger" onPress={onNotDone}>
                Not Done
              </Button>
              <Button color="secondary" variant="flat" onPress={onVerifiedClose}>
                Close
              </Button>
            </ModalBody>
          </>
        </ModalContent>
      </Modal>
    </>
  );
}

export default VerifiedModal;
