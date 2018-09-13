import java.io.BufferedReader;
import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStreamReader;
import java.io.PrintWriter;
import java.net.Socket;


public class RequestThread extends Thread {
	
	Socket s; // socket connection
	int n; // request number
	File dir; // staging directory
	String file;
	
	public RequestThread(Socket s, int n) {
		this.s=s;
		this.n=n;
		dir = new File("srcFile");
	}
	
	public void run() {
		///creating srcFile if doesn't exists
		dir.mkdirs(); // create staging directory
		
		try {
			BufferedReader in = new BufferedReader(new InputStreamReader(s.getInputStream()));
			PrintWriter out = new PrintWriter(s.getOutputStream(), true);//it is writing to socket
			
			// read input from the PHP script
			file = in.readLine();
			int timeout = Integer.parseInt(in.readLine());
			String contents = in.readLine().replace("@_n_@", "\n");
			String input = in.readLine().replace("@_n_@", "\n");
			String lang = in.readLine();
			///System.out.println("Compiling " + file + "...");
			//System.out.println(contents);
			
			// create the sample input file
			PrintWriter writer = new PrintWriter(new FileOutputStream("srcFile/" + file +"in.txt"));
			writer.println(input);
			writer.close();
			
			Language l = null;
			// create the language specific compiler
			if(lang.equals("cpp"))
				l = new Cpp(file, timeout, contents, dir.getAbsolutePath());
			else if(lang.equals("java"))
				l = new Java(file, timeout, contents, dir.getAbsolutePath());
			
			l.compile(); // compile the file
			
			String errors = compileErrors();
			/**
				
			*/
			if(!errors.equals("")) { // check for compilation errors
				out.println("2");
				out.println(errors);
				//System.out.println(errors);
			}
			else {
				// execute the program and return output
				System.out.println("executing\n");
				System.out.println("time limit : " + timeout);
				l.execute();
				if(l.timedout)	{
					out.println("3");
					///time limit exceeded
				}
				else if(!runtimeErrors().equals("0"))	{
					out.println("4");
					///runtime error
				}
				else {
					out.println("1");
					out.println(execMsg());
				}
			}
			s.close();
		} catch (IOException e) {
			e.printStackTrace();
		}
	}
	
	// method to return the compiler errors
	public String compileErrors() {
		String line, content = "";
		try {
			BufferedReader fin = new BufferedReader(new InputStreamReader(new FileInputStream(dir.getAbsolutePath() + "/" + file + "err.txt")));
			while((line = fin.readLine()) != null)
				content += (line + "\n");
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}
		return content.trim();
	}
	
	// method to return the execution output
	public String execMsg() {
		String line, content = "";
		try {
			BufferedReader fin = new BufferedReader(new InputStreamReader(new FileInputStream(dir.getAbsolutePath() + "/" + file + "out.txt")));
			while((line = fin.readLine()) != null)
				content += (line + "\n");
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}
		return content.trim();
	}
	// method to return the execution output
	public String runtimeErrors() {
		String line, content = "";
		try {
			BufferedReader fin = new BufferedReader(new InputStreamReader(new FileInputStream(dir.getAbsolutePath() + "/" + file + "re.txt")));
			while((line = fin.readLine()) != null)
				content += (line + "\n");
		} catch (FileNotFoundException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}
		return content.trim();
	}
}
