<?php

declare(strict_types=1);

namespace PreemStudio\Conversations\Enum;

/**
 * The severity of the incident or problem that the conversation is about.
 */
enum ConversationSeverity: string
{
    use Concerns\WithAccessHelpers;

    /**
     * A critical problem affecting a significant number of users in a
     * production environment. The issue impacts essential services or renders
     * the service inaccessible, degrading the customer experience.
     */
    case SEV1 = 'SEV1';

    /**
     * A severe problem affecting a limited number of users in a production
     * environment, degrading the customer experience.
     */
    case SEV2 = 'SEV2';

    /**
     * A not-so-major incident that causes errors, excessive load, or minor
     * problems for customers in a production environment.
     */
    case SEV3 = 'SEV3';

    /**
     * A relatively minor problem that affects customer experience without
     * substantially degrading service functionality.
     */
    case SEV4 = 'SEV4';

    /**
     * A low-level problem that causes minor errors—such as formatting or
     * display problems—that doesn’t degrade usability.
     */
    case SEV5 = 'SEV5';

    /**
     * A significant incident that has a broad impact. You should repair the
     * problem as soon as possible to minimize downtime costs, keep customers
     * happy, and maintain your company’s good reputation.
     */
    case P1 = 'p1';

    /**
     * A medium-level incident that may not directly cause lost revenue but may
     * escalate without swift action.
     */
    case P2 = 'p2';

    /**
     * A low-level incident that has almost no chance of reducing revenue.
     * Customer experience may be degraded, but not enough to make them switch
     * to a competitor.
     */
    case P3 = 'p3';
}
