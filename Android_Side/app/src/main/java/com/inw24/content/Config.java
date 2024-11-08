package com.inw24.content;

import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class Config {
    //put your api key which obtained from admin dashboard
    public static final String API_KEY = "gyHg3xc5Za2FGb6hJ7hb1az";

    //public static String BASE_URL = "http://192.168.1.5/Projects/phpStorm/MultiContentApp/";
    public static String BASE_URL = "http://content.inw24.com/";
    public static String GET_MAIN_CATEGORY_URL = BASE_URL + "dashboard/Api/get_main_categories/";
    public static String GET_SUB_CATEGORY_URL = BASE_URL + "dashboard/Api/get_sub_categories/";
    public static String CATEGORY_IMG_URL = BASE_URL + "assets/upload/category/";
    public static String CONTENT_IMG_URL = BASE_URL + "assets/upload/content/";
    public static String GET_CONTENT_BY_CATEGORY_URL = BASE_URL + "dashboard/Api/get_content_by_category/";
    public static String GET_ONE_CONTENT_URL = BASE_URL + "dashboard/Api/get_one_content/";

    public static String TOTAL_CONTENT_VIEWED_URL = BASE_URL + "dashboard/Api/total_content_viewed/";

    public static String PAGE_TERMS = BASE_URL + "dashboard/Api/get_one_page/1/";
    public static String PAGE_CONTACT_US = BASE_URL + "dashboard/Api/get_one_page/2/";
    public static String PAGE_ABOUT_US = BASE_URL + "dashboard/Api/get_one_page/3/";
    public static String PAGE_FAQ = BASE_URL + "dashboard/Api/get_one_page/4/";
    public static String PAGE_PRIVACY_POLICY = BASE_URL + "dashboard/Api/get_one_page/10/";
    public static String PAGE_HELP = BASE_URL + "dashboard/Api/get_one_page/5/";
    public static String GET_SLIDER_URL = BASE_URL + "dashboard/Api/get_sliders";
    public static String GET_SLIDER_IMG_URL = BASE_URL + "assets/upload/slider/";

    public static String GET_FEATURED_CONTENT_URL = BASE_URL + "dashboard/Api/get_featured_content/";
    public static String GET_LATEST_CONTENT_URL = BASE_URL + "dashboard/Api/get_last_content/";
    public static String GET_CONTENT_BY_SEARCH_URL = BASE_URL + "dashboard/Api/get_content_by_search/";

    public static String REGISTER_REQUEST_URL = BASE_URL + "dashboard/Api/user_register/";
    public static String LOGIN_REQUEST_URL = BASE_URL + "dashboard/Api/user_login/";
    public static String EXTERNAL_FORGOT_PASSWORD_URL = BASE_URL + "dashboard/Auth/forgot_password/";

    public static String GET_ALL_AFTER_LOGIN_URL = BASE_URL + "dashboard/Api/get_all_after_login/";
    public static String GET_ALL_BEFORE_LOGIN_URL = BASE_URL + "dashboard/Api/get_all_before_login/";
    public static String GET_BOOKMARK_STATUS = BASE_URL + "dashboard/Api/get_bookmark_status/";
    public static String REMOVE_FROM_BOOKMARK_URL = BASE_URL + "dashboard/Api/remove_from_bookmark/";
    public static String ADD_TO_BOOKMARK_URL = BASE_URL + "dashboard/Api/add_to_bookmark/";
    public static String GET_BOOKMARK_CONTENT_URL = BASE_URL + "dashboard/Api/get_bookmark_content/";

    public static String WEB_LOGIN_URL = BASE_URL + "dashboard/";

    //if you use RTL Language e.g : Arabic Language or other, set true
    public static final boolean ENABLE_RTL_MODE = false;
    public static String DIRECTION = "ltr";

    //load more for next list items
    public static final int LOAD_LIMIT = 40; //Load More Limit

    //Webview Font Size
    public static final int Font_Size = 15;

    //Ads Configuration
    //set true to enable or set false to disable
    public static final boolean ENABLE_ADMOB_BANNER_ADS = true;
    public static final boolean ENABLE_ADMOB_INTERSTITIAL_ADS = true;


    //==========================================================================//
    public static String UnixToHuman(String publish_date){
        // ***** Convert Time *****
        long unixSeconds = Long.valueOf(publish_date);
        Date date = new java.util.Date(unixSeconds*1000L); // convert seconds to milliseconds
        SimpleDateFormat sdf = new java.text.SimpleDateFormat("yyyy/MM/dd"); // - HH:mm --> The format of your date
        sdf.setTimeZone(java.util.TimeZone.getTimeZone("GMT+3:30")); // give a timezone reference for formatting
        String humanDate = sdf.format(date);

        return humanDate;
    }


    //==========================================================================//
    public static String TimeAgo(String publish_date){
        // Guide: https://github.com/bancek/android-timeago/blob/master/src/com/lukazakrajsek/timeago/TimeAgo.java
        // ***** Convert Time *****
        long unixSeconds = Long.valueOf(publish_date);

        long diff = new Date().getTime() - (unixSeconds*1000L);

        String prefix = "";
        String suffix = "ago";

        double seconds = Math.abs(diff) / 1000;
        double minutes = seconds / 60;
        double hours = minutes / 60;
        double days = hours / 24;
        double years = days / 365;

        String words;

        if (seconds < 45) {
            words = Math.round(seconds)+" seceond";
        } else if (seconds < 90) {
            words = "1 minute";
        } else if (minutes < 45) {
            words = Math.round(minutes)+" minutes" ;
        } else if (minutes < 90) {
            words = "1 hour";
        } else if (hours < 24) {
            words = Math.round(hours)+" hours";
        } else if (hours < 42) {
            words = "1 day";
        } else if (days < 30) {
            words = Math.round(days)+" days";
        } else if (days < 45) {
            words = "1 month";
        } else if (days < 365) {
            words = Math.round(days / 30) + " months";
        } else if (years < 1.5) {
            words = "1 year";
        } else {
            words = Math.round(years) + " years";
        }

        StringBuilder sb = new StringBuilder();

        if (prefix != null && prefix.length() > 0) {
            sb.append(prefix).append(" ");
        }

        sb.append(words);

        if (suffix != null && suffix.length() > 0) {
            sb.append(" ").append(suffix);
        }

        return sb.toString().trim();
    }


    //==========================================================================//
    public static boolean isEmailValid(String email)
    {
        String regExpn =
                "^(([\\w-]+\\.)+[\\w-]+|([a-zA-Z]{1}|[\\w-]{2,}))@"
                        +"((([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\.([0-1]?"
                        +"[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\."
                        +"([0-1]?[0-9]{1,2}|25[0-5]|2[0-4][0-9])\\.([0-1]?"
                        +"[0-9]{1,2}|25[0-5]|2[0-4][0-9])){1}|"
                        +"([a-zA-Z]+[\\w-]+\\.)+[a-zA-Z]{2,4})$";

        CharSequence inputStr = email;

        Pattern pattern = Pattern.compile(regExpn,Pattern.CASE_INSENSITIVE);
        Matcher matcher = pattern.matcher(inputStr);

        if(matcher.matches())
            return true;
        else
            return false;
    }

}
