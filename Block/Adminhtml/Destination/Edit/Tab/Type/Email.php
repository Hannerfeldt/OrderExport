<?php

/**
 * Product:       Xtento_OrderExport
 * ID:            gwW9u/r0VejpQKC2Ov2BKKnR6pOaUvxDy3w40saMYLo=
 * Last Modified: 2020-06-05T18:04:04+00:00
 * File:          app/code/Xtento/OrderExport/Block/Adminhtml/Destination/Edit/Tab/Type/Email.php
 * Copyright:     Copyright (c) XTENTO GmbH & Co. KG <info@xtento.com> / All rights reserved.
 */

namespace Xtento\OrderExport\Block\Adminhtml\Destination\Edit\Tab\Type;

class Email extends AbstractType
{
    // E-Mail Configuration
    public function getFields(\Magento\Framework\Data\Form $form)
    {
        $model = $this->registry->registry('orderexport_destination');
        // Set default values
        if (!$model->getId()) {
            $model->setEmailAttachFiles(1);
        }

        $fieldset = $form->addFieldset('config_fieldset', [
            'legend' => __('E-Mail Export Configuration'),
        ]
        );

        $fieldset->addField('email_sender', 'text', [
            'label' => __('E-Mail From Address'),
            'name' => 'email_sender',
            'note' => __('Enter the email address that should be set as the sender of the email. If you need to specify the "From" name, enter the e-mail address in this format: some@email.com|Some Sender Name'),
            'required' => true
        ]
        );
        $fieldset->addField('email_recipient', 'text', [
            'label' => __('E-Mail Recipient Address'),
            'name' => 'email_recipient',
            'note' => __('Enter the email address where exports should be sent to. Separate multiple emails using commas.'),
            'required' => true
        ]
        );
        $fieldset->addField('email_bcc', 'text', [
            'label' => __('E-Mail BCC'),
            'name' => 'email_bcc',
            'note' => __('Enter BCC recipients who should receive a blind copy of the email. Separate multiple emails using commas.')
        ]
        );
        $fieldset->addField('email_subject', 'text', [
            'label' => __('E-Mail Subject'),
            'name' => 'email_subject',
            'note' => __('Subject of email. Available variables: %d%, %m%, %y%, %Y%, %h%, %i%, %s%, %recordcount%, %lastexportedincrementid%, %exportid%'),
        ]
        );
        $fieldset->addField('email_body', 'textarea', [
            'label' => __('E-Mail Text'),
            'name' => 'email_body',
            'note' => __('Email text (body text). Available variables: %d%, %m%, %y%, %Y%, %h%, %i%, %s%, %exportid%, %lastexportedincrementid%, %recordcount%, %content% (%content% contains the data generated by the export)'),
        ]
        );
        $fieldset->addField('email_attach_files', 'select', [
            'label' => __('Attach exported files to email'),
            'name' => 'email_attach_files',
            'values' => $this->yesNo->toOptionArray(),
            'note' => __('Should exported files be attached to the email sent?'),
        ]
        );
        $fieldset->addField('email_send_files_separately', 'select', [
            'label' => __('Send each file as separate email'),
            'name' => 'email_send_files_separately',
            'values' => $this->yesNo->toOptionArray(),
            'note' => __('If enabled, each file generated by the profile will send a separate email with just that single file as the attachment. Thus, 10 generated files = 10 emails.'),
        ]
        );
    }
}