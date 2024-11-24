<?php

namespace App\Http\Controllers\TelegramApi\Types;

use App\Http\Controllers\TelegramApi\Types\MessageDTO as Message;
use App\Http\Controllers\TelegramApi\Types\CallbackQueryDTO as CallbackQuery;


/**
 *   This object represents an incoming update. At most one of the optional parameters can be present in any given update.
 *   https://core.telegram.org/bots/api#update
 */
class UpdateDTO
{
    public int $update_id;
    public ?Message $message = null;
    public ?Message $edited_message = null;
    public ?Message $channel_post = null;
    public ?Message $edited_channel_post = null;
    // public ?BusinessConnection $business_connection = null;
    public ?Message $business_message = null;
    public ?Message $edited_business_message = null;
    //public ?BusinessMessagesDeleted $deleted_business_messages = null;
    // public ?MessageReactionUpdated $message_reaction = null;
    // public ?MessageReactionCountUpdated $message_reaction_count = null;
    // public ?InlineQuery $inline_query = null;
    // public ?ChosenInlineResult $chosen_inline_result = null;
     public ?CallbackQuery $callback_query = null;
    // public ?ShippingQuery $shipping_query = null;
    // public ?PreCheckoutQuery $pre_checkout_query = null;
    // public ?PaidMediaPurchased $purchased_paid_media = null;
    // public ?Poll $poll = null;
    // public ?PollAnswer $poll_answer = null;
    // public ?ChatMemberUpdated $my_chat_member = null;
    // public ?ChatMemberUpdated $chat_member = null;
    // public ?ChatJoinRequest $chat_join_request = null;
    // public ?ChatBoostUpdated $chat_boost = null;
    // public ?ChatBoostRemoved $removed_chat_boost = null;
    public function __construct(array $update){
        $this->update_id = $update['update_id'];
        $this->message = isset($update['message']) ? new Message($update['message']) : null;
        $this->edited_message = isset($update['edited_message']) ? new Message($update['edited_message']) : null;
        $this->channel_post = isset($update['channel_post']) ? new Message($update['channel_post']) : null;
        $this->edited_channel_post = isset($update['edited_channel_post']) ? new Message($update['edited_channel_post']) : null;
        $this->business_message = isset($update['business_message']) ? new Message($update['business_message']) : null;
        $this->edited_business_message = isset($update['edited_business_message']) ? new Message($update['edited_business_message']) : null;
        /// continua
        $this->callback_query = isset($update['callback_query']) ? new CallbackQuery($update['callback_query']) : null;
    }
}