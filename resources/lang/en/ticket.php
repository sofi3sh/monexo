<?php

return [
    'name' => 'Tickets',
    'tab-ticket-my' => 'My tickets',
    'tab-ticket-partners' => 'Ticket partners',
    'tab-ticket-template' => 'Pattern',
    'tab-my' => [
        'id' => 'id',
        'theme' => 'Theme',
        'text' => 'Text',
        'attachment' => 'Attachments',
        'date-time' => 'Time and date of request',
        'created' => 'Created by',
        'unread' => 'Unread'
    ],
    'tab-partners' => [
        'id' => 'id',
        'type-ticket' => 'Type ticket',
        'theme' => 'Theme',
        'text' => 'Text',
        'attachment' => 'Attachment',
        'user-name' => 'User name',
        'user-email' => 'User email',
        'user-phone' => 'User Phone',
        'date-create' => 'Date create',
        'status' => 'Status',
    ],
    'tab-template' => [
        'edit' => 'Edit',
        'id' => 'id',
        'template' => 'Шаблон',
        'created_at' => 'Дата создания',
        'updated_at' => 'Дата редактирования',
        'delete' => 'Delete',
    ],
    'form' => [
        'title' => 'Feedback form',
        'submit' => 'Submit',
        'back' => 'Return back',
        'theme' => 'Subject of the appeal',
        'appeal' => 'Request type',
        'question' => 'Message text',
    ],
    'form-template' => [
        'title' => 'Form for creating a ticket template',
        'submit' => 'Save template',
        'back' => 'Back',
        'id' => 'id',
        'template' => 'Template',
    ],
    'store' => [
        'theme' => 'The field "Subject of the appeal" must be filled in.',
        'appeal_id' => 'The field "Type of request" must be filled in.',
        'question' => 'The field "Message text" must be filled in.',
    ],
    'correspondence' => [
        'created_at' => 'Дата и время: ',
        'author_name' => 'Author',
        'author_email' => 'Email',
        'author_phone' => 'Phone',
        'question' => 'Question:',
        'answer' => 'Answer',
        'button-close' => 'Close',
        'view-attachment' => 'View attachments',
    ],
    'attachment' => [
        'title' => 'Attachments',
        'button-close' => 'Close',
    ],
    'front' => [
        'title' => 'Contact support',
        'name' => 'Your name:',
        'email' => 'Email',
        'phone' => 'Phone',
        'submit' => 'Submit',
        'message' => 'Message',
        'success' => '
        <p>Your question has been successfully delivered.</p>
        <p>The answer to the question will be in your personal account in the section with tickets.</p>
        <p>If you are not in the system, expect a reply to your mail.</p>
        '
    ],
    'validation' => [
        'full_name_required'    => 'The field "Your name" must be filled in.',
        'email_required'        => 'The "Email" field must be filled in.',
        'email_email'           => 'The "Email" field is not correct.',
        'phone_required'        => 'The field "Phone" must be filled in.',
        'question_required'     => 'The "Question" field must be filled in.',
    ],
    'email' => [
        'hello' => 'Hello, you left a question on the site monexo-invest.com',
    ],
    'messages' => [
        'success' => 'Your request has been accepted, expect a response.',
    ],
    'instruction' => [
        'btn' => 'Instruction',
        'title' => 'How to use the ticket system',
        'content' => 'In order to leave a support request in the Monexo system, in your personal account you need to go to the Tickets section. In the Tickets section, there are tabs My tickets and Tickets of partners.

        <img src="/img/dashboard/ticket/ticket-instruction.png" style="max-width: 100%"/>

        The My Tickets tab displays a list of your tickets. When clicking on an entry in the ticket list, a pop-up window appears with the correspondence between the user and support. The subject of the request serves as the title of the pop-up window, and the type of request is indicated as the subtitle.
        
        When you click on the Create ticket button, a form appears for creating a support ticket. Specify here the Subject of the appeal, the Type of appeal and, in fact, the Text of the appeal with a description of your problem.
        
        Please note that there are the following types of hits:
        - affiliate program,
        - passive income,
        - innovations on the site,
        - company products,
        - company events,
        - replenishment / withdrawal,
        - technical difficulties.
        
        It should be borne in mind that all types, except the last two, go not only to the site administration, but also to the mentor, who must answer this question within 5 working days.
        
        If you are a mentor, you can check the requests of your referrals on the Partner Tickets tab in the Tickets section.
        
        The ticket system is designed to simplify the interaction between users and the platform. Typically, in the main areas of appeal go not to the administration, but to mentors, which speeds up the processing, relieves the burden from the technical and financial departments, and allows the company to develop more rapidly, spending time on the development of new functions and chips. '
    ],
];
