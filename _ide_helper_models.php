<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * 
 *
 * @mixin Builder
 * @property int $id
 * @property string $file_name
 * @property string|null $doc_type
 * @property int $user_id
 * @property int|null $eoi_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $owner
 * @method static \Illuminate\Database\Eloquent\Builder|Document newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Document query()
 * @method static \Illuminate\Database\Eloquent\Builder|Document search($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereDocType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereEoiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Document whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperDocument {}
}

namespace App\Models{
/**
 * 
 *
 * @mixin Builder
 * @property int $id
 * @property string|null $current_role
 * @property string|null $employment_history
 * @property string|null $qualifications
 * @property string|null $training
 * @property \Illuminate\Support\Carbon|null $submitted_at
 * @property string|null $feedback
 * @property string|null $notes
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|EOI newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EOI newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EOI query()
 * @method static \Illuminate\Database\Eloquent\Builder|EOI whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EOI whereCurrentRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EOI whereEmploymentHistory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EOI whereFeedback($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EOI whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EOI whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EOI whereQualifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EOI whereSubmittedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EOI whereTraining($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EOI whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EOI whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperEOI {}
}

namespace App\Models{
/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property string $product_name
 * @property string $price_ex_vat
 * @property string $order_status
 * @property string|null $payment_intent
 * @property string $stripe_session_id
 * @property string|null $stripe_hosted_invoice_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePaymentIntent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order wherePriceExVat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereProductName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStripeHostedInvoiceUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereStripeSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperOrder {}
}

namespace App\Models{
/**
 * 
 *
 * @mixin Builder
 * @property int $id
 * @property string $price_type
 * @property string $amount
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property int $updated_by
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $updatedBy
 * @method static \Database\Factories\PricesFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Prices newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prices newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Prices query()
 * @method static \Illuminate\Database\Eloquent\Builder|Prices whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prices whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prices whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prices whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prices wherePriceType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prices whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prices whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Prices whereUpdatedBy($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperPrices {}
}

namespace App\Models{
/**
 * 
 *
 * @mixin Builder
 * @property int $id
 * @property int $order
 * @property string $file_name
 * @property string|null $doc_type
 * @property int $version
 * @property string $release_month
 * @property string $release_year
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PublicDocument newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicDocument newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicDocument query()
 * @method static \Illuminate\Database\Eloquent\Builder|PublicDocument whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicDocument whereDocType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicDocument whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicDocument whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicDocument whereReleaseMonth($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicDocument whereReleaseYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicDocument whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PublicDocument whereVersion($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperPublicDocument {}
}

namespace App\Models{
/**
 * 
 *
 * @mixin Builder
 * @property int $id
 * @property string|null $feedback
 * @property string|null $notes
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Submission newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Submission newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Submission query()
 * @method static \Illuminate\Database\Eloquent\Builder|Submission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submission whereFeedback($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submission whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submission whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Submission whereUserId($value)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperSubmission {}
}

namespace App\Models{
/**
 * 
 *
 * @mixin Builder
 * @property int $id
 * @property \Illuminate\Support\Carbon $admission_date
 * @property \Illuminate\Support\Carbon $submission_deadline
 * @property int $updated_by
 * @property int|null $deleted_by
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $updatedBy
 * @method static \Database\Factories\SubmissionDateFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|SubmissionDate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubmissionDate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubmissionDate onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SubmissionDate query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubmissionDate whereAdmissionDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubmissionDate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubmissionDate whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubmissionDate whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubmissionDate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubmissionDate whereSubmissionDeadline($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubmissionDate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubmissionDate whereUpdatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubmissionDate withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SubmissionDate withoutTrashed()
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperSubmissionDate {}
}

namespace App\Models{
/**
 * 
 *
 * @mixin Builder
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string|null $phone_main
 * @property string|null $phone_mobile
 * @property int $registration_fee_paid
 * @property string|null $eoi_status
 * @property int $submission_count
 * @property int $submission_fee_paid
 * @property string|null $submission_status
 * @property \Illuminate\Support\Carbon|null $submission_interview_at
 * @property \Illuminate\Support\Carbon|null $submission_accepted_at
 * @property int|null $submission_accepted_by
 * @property string|null $registration_pathway
 * @property \Illuminate\Support\Carbon|null $became_registrant_at
 * @property string|null $cpd_last_submitted_at
 * @property string|null $renewal_fee_last_paid_at
 * @property \Illuminate\Support\Carbon|null $registration_expires_at
 * @property \Illuminate\Support\Carbon|null $declined_at
 * @property int|null $declined_by
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read User|null $acceptedBy
 * @property-read User|null $declinedBy
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Document> $documents
 * @property-read int|null $documents_count
 * @property-read \App\Models\EOI|null $eoi
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \App\Models\Submission|null $submission
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User publicSearch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|User search($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereBecameRegistrantAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCpdLastSubmittedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeclinedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDeclinedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEoiStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneMain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhoneMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRegistrationExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRegistrationFeePaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRegistrationPathway($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRenewalFeeLastPaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSubmissionAcceptedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSubmissionAcceptedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSubmissionCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSubmissionFeePaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSubmissionInterviewAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSubmissionStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User withoutRole($roles, $guard = null)
 * @mixin \Eloquent
 */
	#[\AllowDynamicProperties]
	class IdeHelperUser {}
}

