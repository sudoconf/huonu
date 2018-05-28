package com.huonu.utils;

import java.util.ArrayList;
import java.util.List;

public class ListUtils {
	
	
	 /**
     * 
     * 将数组按照固定大小分成二维数组
     *
     * @param targe
     * @param size
     * @return
     */
    public static<T>  List<List<T>>  createList(List<T> targe,int size) {
		List<List<T>> listArr = new ArrayList<List<T>>();
		int count=targe.size();
		//获取被拆分的数组个数
		int arrSize = count%size==0?count/size:count/size+1;
		for(int i=0;i<arrSize;i++) {
			List<T>  sub = new ArrayList<T>();
			//把指定索引数据放入到list中
			for(int j=i*size;j<=size*(i+1)-1;j++) {
				if(j<=count-1) {
					sub.add(targe.get(j));
				}
			}
			listArr.add(sub);
		}
		return listArr;
	}

}
