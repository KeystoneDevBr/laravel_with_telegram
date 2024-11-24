<?php

namespace App\Http\Controllers\TelegramApi\Types;

use App\Http\Controllers\TelegramApi\Types\ChatDTO as Chat;
use App\Http\Controllers\TelegramApi\Types\UserDTO as User;
use App\Http\Controllers\TelegramApi\Types\MessageEntityDTO as MessageEntity;
use App\Http\Controllers\TelegramApi\Types\PhotoSizeDTO as PhotoSize;
use App\Http\Controllers\TelegramApi\Types\InlineKeyboardMarkup;


/**
 * This object represents a message.
 * saiba mais em https://core.telegram.org/bots/api#message
 */
class MessageDTO
{
    // Required fields
    public int $message_id;

    public User $from;
    public int $date;
    public Chat $chat;

    // Optional fields
    // public ?int $message_thread_id = null;
    // public ?User $from = null;
    public ?Chat $sender_chat = null;
    public ?int $sender_boost_count = null;
    public ?User $sender_business_bot = null;
    // public ?string $business_connection_id = null;
    // public ?MessageOrigin $forward_origin = null;
    // public ?bool $is_topic_message = null;
    // public ?bool $is_automatic_forward = null;
    // public ?MessageDTO $reply_to_message = null;
    // public ?ExternalReplyInfo $external_reply = null;
    // public ?TextQuote $quote = null;
    // public ?Story $reply_to_story = null;
    // public ?User $via_bot = null;
    // public ?int $edit_date = null;
    // public ?bool $has_protected_content = null;
    // public ?bool $is_from_offline = null;
    // public ?string $media_group_id = null;
    // public ?string $author_signature = null;
    public ?string $text = null;
    /**
     * Summary of quote_entities
     * @var MessageEntity[];
     */
    public ?array $entities = null; // Array of MessageEntity
    // public ?LinkPreviewOptions $link_preview_options = null;
    // public ?string $effect_id = null;
    // public ?Animation $animation = null;
    // public ?Audio $audio = null;
    // public ?Document $document = null;
    // public ?PaidMediaInfo $paid_media = null;
    public ?array $photo = null; // Array of PhotoSize
    // public ?Sticker $sticker = null;
    // public ?Story $story = null;
    // public ?Video $video = null;
    // public ?VideoNote $video_note = null;
    // public ?Voice $voice = null;
    // public ?string $caption = null;
    // public ?array $caption_entities = null; // Array of MessageEntity
    // public ?bool $show_caption_above_media = null;
    // public ?bool $has_media_spoiler = null;
    // public ?Contact $contact = null;
    // public ?Dice $dice = null;
    // public ?Game $game = null;
    // public ?Poll $poll = null;
    // public ?Venue $venue = null;
    // public ?Location $location = null;
    // public ?array $new_chat_members = null; // Array of User
    // public ?User $left_chat_member = null;
    // public ?string $new_chat_title = null;
    // public ?array $new_chat_photo = null; // Array of PhotoSize
    // public ?bool $delete_chat_photo = null;
    // public ?bool $group_chat_created = null;
    // public ?bool $supergroup_chat_created = null;
    // public ?bool $channel_chat_created = null;
    // public ?MessageAutoDeleteTimerChanged $message_auto_delete_timer_changed = null;
    // public ?int $migrate_to_chat_id = null;
    // public ?int $migrate_from_chat_id = null;
    // public ?MaybeInaccessibleMessage $pinned_message = null;
    // public ?Invoice $invoice = null;
    // public ?SuccessfulPayment $successful_payment = null;
    // public ?RefundedPayment $refunded_payment = null;
    // public ?UsersShared $users_shared = null;
    // public ?ChatShared $chat_shared = null;
    // public ?string $connected_website = null;
    // public ?WriteAccessAllowed $write_access_allowed = null;
    // public ?PassportData $passport_data = null;
    // public ?ProximityAlertTriggered $proximity_alert_triggered = null;
    // public ?ChatBoostAdded $boost_added = null;
    // public ?ChatBackground $chat_background_set = null;
    // public ?ForumTopicCreated $forum_topic_created = null;
    // public ?ForumTopicEdited $forum_topic_edited = null;
    // public ?ForumTopicClosed $forum_topic_closed = null;
    // public ?ForumTopicReopened $forum_topic_reopened = null;
    // public ?GeneralForumTopicHidden $general_forum_topic_hidden = null;
    // public ?GeneralForumTopicUnhidden $general_forum_topic_unhidden = null;
    // public ?GiveawayCreated $giveaway_created = null;
    // public ?Giveaway $giveaway = null;
    // public ?GiveawayWinners $giveaway_winners = null;
    // public ?GiveawayCompleted $giveaway_completed = null;
    // public ?VideoChatScheduled $video_chat_scheduled = null;
    // public ?VideoChatStarted $video_chat_started = null;
    // public ?VideoChatEnded $video_chat_ended = null;
    // public ?VideoChatParticipantsInvited $video_chat_participants_invited = null;
    // public ?WebAppData $web_app_data = null;
    public ?InlineKeyboardMarkup $reply_markup = null;

    /**
     * Constructor to initialize the object
     */
    public function __construct(array $message)
    {
        $this->message_id = $message['message_id'];
        $this->from = new User($message['from']);
        $this->date = $message['date'];
        $this->chat = new Chat($message['chat']);
        $this->sender_chat = isset($message['sender_chat']) ? new Chat($message['sender_chat']) : null;
        $this->sender_boost_count = $message['sender_boost_count'] ?? null;
        $this->sender_business_bot = isset($message['sender_business_bot']) ? new User($message['sender_business_bot']) : null;
        $this->text = $message['text'] ?? null;
        $this->entities = isset($message['entities']) ?
            array_map(
                fn($entity) => new MessageEntity($entity),
                $message['entities']
            ) : null;
        $this->photo = isset($message['photo']) ?
            array_map(
                fn($photo) => new PhotoSize($photo),
                $message['photo']
            ) : null;
        $this->reply_markup = isset($message['reply_markup']) ? new InlineKeyboardMarkup($message['reply_markup']) : null;
    }
}
