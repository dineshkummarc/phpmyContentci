package com.inw24.content.adapters;

import android.content.Context;
import android.content.Intent;
import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.bumptech.glide.request.RequestOptions;
import com.inw24.content.Config;
import com.inw24.content.activities.OneContentMusicActivity;
import com.inw24.content.models.ContentModel;

import java.util.List;

import com.inw24.content.R;
import com.inw24.content.activities.OneContentLinkActivity;
import com.inw24.content.activities.OneContentTextActivity;
import com.inw24.content.activities.OneContentVideoActivity;

public class ContentAdapter extends RecyclerView.Adapter<ContentAdapter.ContentViewHolder>
{
    private Context context;
    private List<ContentModel> contentModel;

    public ContentAdapter(Context context, List<ContentModel> contentModel) {
        this.context = context;
        this.contentModel = contentModel;
    }

    @NonNull
    @Override
    public ContentViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.rv_content_list, parent, false);
        return new ContentViewHolder(view);
    }

    @Override
    public void onBindViewHolder(@NonNull ContentViewHolder holder, int position) {
        holder.itemView.setTag(contentModel.get(position));

        ContentModel content = contentModel.get(position);

        holder.contentTitle.setText(content.getContent_title());
        Glide.with(context)
                .load(Config.CONTENT_IMG_URL+content.getContent_image())
                .apply(new RequestOptions()
                        //.bitmapTransform(new CenterCrop(context), new RoundedCornersTransformation(context, 0, 0))
                        .placeholder(R.drawable.pre_loading)
                        .fitCenter()
                        .diskCacheStrategy(DiskCacheStrategy.ALL)
                        .dontAnimate())
                .into(holder.contentImage);
        holder.contentDuration.setText(content.getContent_duration());
        holder.contentViewed.setText(content.getContent_viewed()+" "+context.getResources().getString(R.string.txt_viewed));
        holder.categoryTitle.setText(content.getCategory_title());
        holder.contentPublishDate.setText(Config.TimeAgo(content.getContent_publish_date()));
        holder.contentTypeTitle.setText(content.getContent_type_title());
    }

    @Override
    public int getItemCount() {
        return contentModel.size();
    }

    public class ContentViewHolder extends RecyclerView.ViewHolder
    {
        public TextView contentId;
        public TextView contentTitle;
        public ImageView contentImage;
        public TextView contentUrl;
        public TextView contentPrice;
        public TextView contentTypeId;
        public TextView contentAccess;
        public TextView contentUserRoleId;
        public TextView contentDuration;
        public TextView contentViewed;
        public TextView contentLiked;
        public TextView contentPublishDate;
        public TextView contentFeatured;
        public TextView contentSpecial;
        public TextView contentOrientation;
        public TextView categoryTitle;
        public TextView contentTypeTitle;

        public ContentViewHolder(View itemView) {
            super(itemView);
            contentTitle = (TextView) itemView.findViewById(R.id.tv_content_list_title);
            contentImage = (ImageView) itemView.findViewById(R.id.iv_content_list_image);
            categoryTitle = (TextView) itemView.findViewById(R.id.tv_content_list_category);
            contentDuration = (TextView) itemView.findViewById(R.id.tv_content_list_duration);
            contentPublishDate = (TextView) itemView.findViewById(R.id.tv_content_list_date_time);
            contentViewed = (TextView) itemView.findViewById(R.id.tv_content_list_total_viewed);
            contentTypeTitle = (TextView) itemView.findViewById(R.id.tv_content_list_type_title);

            itemView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {

                    ContentModel content = (ContentModel) view.getTag();

                    String contentId = content.getContent_id();
                    String contentTitle = content.getContent_title();
                    String categoryTitle = content.getCategory_title();
                    String contentImage = content.getContent_image();
                    String contentUrl = content.getContent_url();
                    String contentDuration = content.getContent_duration();
                    String contentViewed = content.getContent_viewed();
                    String contentPublishDate = content.getContent_publish_date();
                    String contentTypeId = content.getContent_type_id();
                    String contentTypeTitle = content.getContent_type_title();
                    String contentUserRoleId = content.getContent_user_role_id();
                    String contentOrientation = content.getContent_orientation();


                    // contentTypeId = 1: Video | 2: Music | 3: Image | 4: Link | 5: Text | 6: Ads
                    if(contentTypeId.equals("1") || contentTypeId.equals("2")) // Video
                    {
                        //Send content information to OneContentVideo Activity
                        Intent intentContent = new Intent(context, OneContentVideoActivity.class);
                        intentContent.putExtra("buttonText", context.getString(R.string.txt_button_show));
                        intentContent.putExtra("contentId", contentId);
                        intentContent.putExtra("contentTitle", contentTitle);
                        intentContent.putExtra("categoryTitle", categoryTitle);
                        intentContent.putExtra("contentImage", contentImage);
                        intentContent.putExtra("contentUrl", contentUrl);
                        intentContent.putExtra("contentDuration", contentDuration);
                        intentContent.putExtra("contentViewed", contentViewed);
                        intentContent.putExtra("contentPublishDate", contentPublishDate);
                        intentContent.putExtra("contentTypeId", contentTypeId);
                        intentContent.putExtra("contentTypeTitle", contentTypeTitle);
                        intentContent.putExtra("contentUserRoleId", contentUserRoleId);
                        intentContent.putExtra("contentOrientation", contentOrientation);
                        context.startActivity(intentContent);

                    }else if(contentTypeId.equals("2")) { // Music
                        //Send content information to OneContentMusic Activity
                        Intent intentContent = new Intent(context, OneContentMusicActivity.class);
                        intentContent.putExtra("buttonText", context.getString(R.string.txt_button_show));
                        intentContent.putExtra("contentId", contentId);
                        intentContent.putExtra("contentTitle", contentTitle);
                        intentContent.putExtra("categoryTitle", categoryTitle);
                        intentContent.putExtra("contentImage", contentImage);
                        intentContent.putExtra("contentUrl", contentUrl);
                        intentContent.putExtra("contentDuration", contentDuration);
                        intentContent.putExtra("contentViewed", contentViewed);
                        intentContent.putExtra("contentPublishDate", contentPublishDate);
                        intentContent.putExtra("contentTypeId", contentTypeId);
                        intentContent.putExtra("contentTypeTitle", contentTypeTitle);
                        intentContent.putExtra("contentUserRoleId", contentUserRoleId);
                        intentContent.putExtra("contentOrientation", contentOrientation);
                        context.startActivity(intentContent);

                    }else if(contentTypeId.equals("3") || contentTypeId.equals("5")) { //Text and Image
                        //Send content information to OneContentText Activity
                        Intent intentContent = new Intent(context, OneContentTextActivity.class);
                        intentContent.putExtra("buttonText", context.getString(R.string.txt_button_show));
                        intentContent.putExtra("contentId", contentId);
                        intentContent.putExtra("contentTitle", contentTitle);
                        intentContent.putExtra("categoryTitle", categoryTitle);
                        intentContent.putExtra("contentImage", contentImage);
                        intentContent.putExtra("contentUrl", contentUrl);
                        intentContent.putExtra("contentDuration", contentDuration);
                        intentContent.putExtra("contentViewed", contentViewed);
                        intentContent.putExtra("contentPublishDate", contentPublishDate);
                        intentContent.putExtra("contentTypeId", contentTypeId);
                        intentContent.putExtra("contentTypeTitle", contentTypeTitle);
                        intentContent.putExtra("contentUserRoleId", contentUserRoleId);
                        intentContent.putExtra("contentOrientation", contentOrientation);
                        context.startActivity(intentContent);

                    }else if(contentTypeId.equals("4")) { //Browser Games
                        //Send content information to OneContentLink Activity
                        Intent intentContent = new Intent(context, OneContentLinkActivity.class);
                        intentContent.putExtra("buttonText", context.getString(R.string.txt_button_game));
                        intentContent.putExtra("contentId", contentId);
                        intentContent.putExtra("contentTitle", contentTitle);
                        intentContent.putExtra("categoryTitle", categoryTitle);
                        intentContent.putExtra("contentImage", contentImage);
                        intentContent.putExtra("contentUrl", contentUrl);
                        intentContent.putExtra("contentDuration", contentDuration);
                        intentContent.putExtra("contentViewed", contentViewed);
                        intentContent.putExtra("contentPublishDate", contentPublishDate);
                        intentContent.putExtra("contentTypeId", contentTypeId);
                        intentContent.putExtra("contentTypeTitle", contentTypeTitle);
                        intentContent.putExtra("contentUserRoleId", contentUserRoleId);
                        intentContent.putExtra("contentOrientation", contentOrientation);
                        context.startActivity(intentContent);

                    }else if(contentTypeId.equals("6")) { //Ads
                        Toast.makeText(view.getContext(), R.string.txt_not_supported, Toast.LENGTH_LONG).show();

                    }else if(contentTypeId.equals("7")) { //Download
                        //Send content information to OneContentLink Activity
                        Intent intentContent = new Intent(context, OneContentLinkActivity.class);
                        intentContent.putExtra("buttonText", context.getString(R.string.txt_button_download));
                        intentContent.putExtra("contentId", contentId);
                        intentContent.putExtra("contentTitle", contentTitle);
                        intentContent.putExtra("categoryTitle", categoryTitle);
                        intentContent.putExtra("contentImage", contentImage);
                        intentContent.putExtra("contentUrl", contentUrl);
                        intentContent.putExtra("contentDuration", contentDuration);
                        intentContent.putExtra("contentViewed", contentViewed);
                        intentContent.putExtra("contentPublishDate", contentPublishDate);
                        intentContent.putExtra("contentTypeId", contentTypeId);
                        intentContent.putExtra("contentTypeTitle", contentTypeTitle);
                        intentContent.putExtra("contentUserRoleId", contentUserRoleId);
                        intentContent.putExtra("contentOrientation", contentOrientation);
                        context.startActivity(intentContent);

                    }else if(contentTypeId.equals("8")) { //Introduce
                        //Send content information to OneContentLink Activity
                        Intent intentContent = new Intent(context, OneContentLinkActivity.class);
                        intentContent.putExtra("buttonText", context.getString(R.string.txt_button_show));
                        intentContent.putExtra("contentId", contentId);
                        intentContent.putExtra("contentTitle", contentTitle);
                        intentContent.putExtra("categoryTitle", categoryTitle);
                        intentContent.putExtra("contentImage", contentImage);
                        intentContent.putExtra("contentUrl", contentUrl);
                        intentContent.putExtra("contentDuration", contentDuration);
                        intentContent.putExtra("contentViewed", contentViewed);
                        intentContent.putExtra("contentPublishDate", contentPublishDate);
                        intentContent.putExtra("contentTypeId", contentTypeId);
                        intentContent.putExtra("contentTypeTitle", contentTypeTitle);
                        intentContent.putExtra("contentUserRoleId", contentUserRoleId);
                        intentContent.putExtra("contentOrientation", contentOrientation);
                        context.startActivity(intentContent);

                    }else{
                        Toast.makeText(view.getContext(), R.string.txt_not_supported, Toast.LENGTH_LONG).show();
                        //Toast.makeText(view.getContext(), "Role: "+contentUserRoleId, Toast.LENGTH_LONG).show();
                    }
                }

            });
        }
    }
}
