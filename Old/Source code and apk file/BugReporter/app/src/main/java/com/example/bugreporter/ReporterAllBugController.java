package com.example.bugreporter;

import android.content.Context;
import java.util.ArrayList;

public class ReporterAllBugController {
    Bug bug;

    public ReporterAllBugController(Context context)
    {
        bug = new Bug(context);
    }

    public ArrayList<String> getBug(){
        ArrayList<String> list = bug.allBug();
        return list;
    }
}
